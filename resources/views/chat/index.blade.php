@extends('layouts.app')

@section('title', 'Asistente IA')

@section('content')
    <div class="p-4 max-w-3xl mx-auto">

        <div class="mb-6 pb-4 border-b border-base-300">
            <h1 class="text-2xl font-bold text-base-content">Asistente Virtual</h1>
            <p class="text-sm text-base-content/60 mt-1">
                Puedes continuar navegando mientras se procesa tu pregunta.
            </p>
        </div>

        {{-- Formulario --}}
        <div class="card bg-base-100 shadow-sm border border-base-200 rounded-xl mb-6">
            <div class="card-body p-6">
                <h2 class="font-bold text-sm text-base-content/70 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    Hacer una pregunta
                </h2>

                <form action="{{ route('chat.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="form-control">
                        <textarea name="question" rows="3" placeholder="Escribe tu pregunta aquí..."
                            class="textarea textarea-bordered w-full resize-none focus:textarea-primary text-sm
                               @error('question') textarea-error @enderror">{{ old('question') }}</textarea>
                        @error('question')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    {{-- Sugerencias de preguntas permitidas --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach (['¿Dónde busco información actualizada sobre la empresa?', '¿Qué redes sociales puedo consultar para informarme?', '¿Qué es la UNE?'] as $suggestion)
                            <button type="button"
                                onclick="document.querySelector('textarea[name=question]').value = '{{ $suggestion }}'"
                                class="badge badge-outline text-xs py-2.5 px-3 cursor-pointer hover:bg-base-200 transition-colors text-base-content/60">
                                {{ $suggestion }}
                            </button>
                        @endforeach
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-6 font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Enviar pregunta
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Historial --}}
        <div class="space-y-3">
            <h2 class="text-sm font-bold text-base-content/50 uppercase tracking-wider">Historial</h2>

            @forelse ($messages as $message)
                <div class="card bg-base-100 border border-base-200 shadow-sm rounded-xl hover:shadow-md transition-shadow">
                    <div class="card-body p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm text-base-content truncate">
                                    {{ $message->question }}
                                </p>
                                <p class="text-xs text-base-content/50 mt-0.5">
                                    {{ $message->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2 flex-shrink-0">
                                {{-- Badge de estado --}}
                                @if ($message->status === 'pending' || $message->status === 'processing')
                                    <span class="badge badge-warning badge-sm font-bold gap-1">
                                        <span class="loading loading-spinner loading-xs"></span>
                                        Procesando
                                    </span>
                                @elseif ($message->status === 'completed')
                                    <a href="{{ route('chat.show', $message) }}"
                                        class="btn btn-xs bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none gap-1">
                                        Ver respuesta
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="badge badge-error badge-sm font-bold">Error</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-base-content/40 text-sm italic">
                    Aún no has realizado ninguna pregunta.
                </div>
            @endforelse

            @if ($messages->hasPages())
                <div class="pt-2">{{ $messages->links() }}</div>
            @endif
        </div>
    </div>
@endsection
