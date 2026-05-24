<?php

namespace App\Jobs;

use App\Models\ChatMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class ProcessChatMessage implements ShouldQueue
{
    use Queueable;

    public int $timeout = 120;
    public int $tries   = 2;

    public function __construct(public ChatMessage $chatMessage) {}

    public function handle(): void
    {
        $this->chatMessage->update(['status' => 'processing']);

        $systemPrompt = $this->buildSystemPrompt();

        try {
            $response = Http::timeout(90)->post(
                config('services.ollama.url') . '/api/chat',
                [
                    'model'   => config('services.ollama.model'),
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user',   'content' => $this->chatMessage->question],
                    ],
                    'stream'  => false,
                    'options' => ['temperature' => 0.2], // baja temperatura = más determinístico
                ]
            );

            $answer = $response->successful()
                ? ($response->json('message.content') ?? 'No se pudo generar respuesta.')
                : 'Error al contactar el servicio de IA (' . $response->status() . ').';

            $status = $response->successful() ? 'completed' : 'failed';
        } catch (\Exception $e) {
            $answer = 'El servicio de IA no está disponible en este momento.';
            $status = 'failed';
        }

        $this->chatMessage->update([
            'status' => $status,
            'answer' => $answer,
        ]);
    }

    private function buildSystemPrompt(): string
    {
        // Preguntas y respuestas permitidas — agrega aquí las que necesites
        $allowed = [
            [
                'pregunta'  => '¿Dónde busco información actualizada sobre la empresa?',
                'respuesta' => 'Puedes encontrar información actualizada en el sitio web oficial de la Unión Eléctrica: https://www.unionelectrica.cu',
            ],
            [
                'pregunta'  => '¿Qué redes sociales puedo consultar para informarme?',
                'respuesta' => 'Puedes seguir a la UNE en X (Twitter) como @OSDE_UNE y en Telegram en t.me/UNE_EEG',
            ],
            [
                'pregunta'  => '¿Qué es la UNE?',
                'respuesta' => 'La Unión Eléctrica de Cuba (UNE) es la entidad encargada de garantizar la generación, transmisión y distribución de energía eléctrica en todo el territorio nacional.',
            ],
        ];

        $listado = '';
        foreach ($allowed as $i => $item) {
            $n = $i + 1;
            $listado .= "{$n}. Pregunta: \"{$item['pregunta']}\"\n"
                . "   Respuesta: {$item['respuesta']}\n\n";
        }

        return <<<PROMPT
Eres el asistente virtual de PUGSA, la plataforma de la Empresa Eléctrica UNE Granma.

INSTRUCCIÓN IMPORTANTE: Solo puedes responder las siguientes preguntas permitidas. Si el usuario pregunta algo diferente, NO respondas esa pregunta. En su lugar, indícale amablemente que solo puedes responder preguntas específicas y muéstrale la lista de preguntas disponibles.

PREGUNTAS PERMITIDAS:
{$listado}
Responde siempre en español, de forma clara y profesional.
PROMPT;
    }
}
