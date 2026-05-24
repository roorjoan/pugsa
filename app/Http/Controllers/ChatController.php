<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessChatMessage;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Vista principal con historial
    public function index()
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('chat.index', compact('messages'));
    }

    // Enviar pregunta → crear registro + despachar job
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $chatMessage = ChatMessage::create([
            'user_id'  => auth()->id(),
            'question' => $request->question,
        ]);

        ProcessChatMessage::dispatch($chatMessage);

        return back()->with('msg', 'Pregunta enviada. Recibirás una notificación cuando la respuesta esté lista.');
    }

    // Ver respuesta específica
    public function show(ChatMessage $chatMessage)
    {
        abort_unless($chatMessage->user_id === auth()->id(), 403);

        return view('chat.show', compact('chatMessage'));
    }

    // Endpoint de polling — llamado cada 5s por el JS del layout
    public function check()
    {
        // Busca mensajes completados que aún no fueron notificados al frontend
        $completed = ChatMessage::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->whereNull('notified_at')
            ->get(['id', 'question']);

        // Marca como notificados para no volver a alertar
        if ($completed->isNotEmpty()) {
            ChatMessage::whereIn('id', $completed->pluck('id'))
                ->update(['notified_at' => now()]);
        }

        return response()->json(['completed' => $completed]);
    }
}
