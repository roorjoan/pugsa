@extends('layouts.app')

@section('title', 'Respuesta del Asistente')

@section('content')
    <div class="p-4 max-w-2xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('chat.index') }}"
                class="inline-flex items-center gap-2 text-sm text-base-content/60 hover:text-base-content transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Volver al historial
            </a>
        </div>

        <div class="card bg-base-100 border border-base-200 shadow-sm rounded-xl overflow-hidden">

            {{-- Pregunta --}}
            <div class="p-6 border-b border-base-200 bg-base-50">
                <p class="text-xs font-bold text-base-content/40 uppercase tracking-wider mb-2">Tu pregunta</p>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#1e3a8a] flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-white text-xs font-bold uppercase">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </span>
                    </div>
                    <p class="text-base-content font-medium">{{ $chatMessage->question }}</p>
                </div>
            </div>

            {{-- Respuesta --}}
            <div class="p-6">
                <p class="text-xs font-bold text-base-content/40 uppercase tracking-wider mb-2">Respuesta del asistente</p>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#5b21b6] flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>

                    @if ($chatMessage->isCompleted())
                        <div class="text-base-content leading-relaxed text-sm">
                            {!! nl2br(e($chatMessage->answer)) !!}
                        </div>
                    @elseif ($chatMessage->status === 'failed')
                        <p class="text-error text-sm">{{ $chatMessage->answer }}</p>
                    @else
                        <div class="flex items-center gap-2 text-base-content/50 text-sm">
                            <span class="loading loading-spinner loading-sm"></span>
                            La respuesta aún se está generando...
                        </div>
                    @endif
                </div>
            </div>

            <div class="px-6 py-3 border-t border-base-200 bg-base-50/50 text-xs text-base-content/40">
                Generado el {{ $chatMessage->updated_at->format('d/m/Y H:i') }}
                · Modelo: {{ config('services.ollama.model') }}
            </div>
        </div>
    </div>
@endsection
