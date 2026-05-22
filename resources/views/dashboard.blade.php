@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6">
        <div class="mb-8 pb-4 border-b border-base-300">
            <h1 class="text-2xl font-bold text-base-content">Bienvenido, {{ auth()->user()->name }}</h1>
            <p class="text-sm text-base-content/60 mt-1">Plataforma Unificada de Gestión de Servicios y Accesos.</p>
        </div>

        <div class="mb-6">
            <h2 class="text-sm font-bold tracking-wider text-base-content/50 uppercase flex items-center gap-2">
                <svg class="w-4 h-4 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z">
                    </path>
                </svg>
                Mis Servicios Disponibles
            </h2>
        </div>

        @if (auth()->user()->services && auth()->user()->services->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach (auth()->user()->services as $service)
                    <div
                        class="card bg-base-100 border border-base-200 shadow-sm hover:shadow-md hover:border-[#5b21b6]/20 transition-all duration-300 rounded-xl overflow-hidden flex flex-col justify-between">

                        <div class="card-body p-6 flex flex-col items-center text-center gap-4">
                            <div
                                class="w-16 h-16 rounded-2xl bg-base-50 border border-base-200 flex items-center justify-center p-2 shadow-inner flex-shrink-0">
                                @if ($service->icon)
                                    <img src="{{ asset('storage/' . $service->icon) }}" alt="Icono {{ $service->name }}"
                                        class="w-full h-full object-contain rounded-lg">
                                @else
                                    <svg class="w-8 h-8 text-base-content/30" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                @endif
                            </div>

                            <div class="space-y-1 w-full">
                                <div class="flex items-center justify-center gap-2">
                                    <h3 class="font-bold text-base-content text-base truncate max-w-[150px]"
                                        title="{{ $service->name }}">
                                        {{ $service->name }}
                                    </h3>
                                </div>

                                <p class="text-xs text-base-content/60 line-clamp-3 h-12 overflow-hidden px-1"
                                    title="{{ $service->description }}">
                                    {{ $service->description ?? 'Este servicio no dispone de una descripción detallada en este momento.' }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <a href="{{ url($service->path) }}"
                                class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none w-full font-semibold rounded-lg shadow-sm group gap-2 transition-colors">
                                Ejecutar
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div
                class="card bg-base-100 border border-base-200 shadow-sm rounded-xl p-12 text-center max-w-md mx-auto mt-12">
                <div
                    class="w-16 h-16 rounded-full bg-base-200 flex items-center justify-center mx-auto mb-4 text-base-content/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-base-content">Sin servicios asignados</h3>
                <p class="text-xs text-base-content/50 mt-1">
                    Actualmente tu usuario no posee permisos de acceso a ningún servicio del sistema. Comunícate con soporte
                    para solicitar accesos.
                </p>
            </div>
        @endif
    </div>
@endsection
