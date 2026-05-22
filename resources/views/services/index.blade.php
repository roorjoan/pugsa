@extends('layouts.app')

@section('title', 'Gestión de Servicios')

@section('content')
    <div class="p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-base-content tracking-tight">Administra los servicios del sistema</h1>
            <a href="{{ route('services.create') }}"
                class="btn border-none bg-[#db4444] hover:bg-[#c93b3b] text-white shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nuevo Servicio
            </a>
        </div>

        <div class="bg-base-100 rounded-xl shadow-sm border border-base-200 overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="text-base-content/60 border-b border-base-200 uppercase text-xs tracking-wider">
                        <th class="px-6 py-4 font-semibold">Servicio</th>
                        <th class="px-6 py-4 font-semibold">Tipo</th>
                        <th class="px-6 py-4 font-semibold">Ruta (Path)</th>
                        <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr class="border-b border-base-200 hover:bg-base-200/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="avatar placeholder">
                                        <div
                                            class="bg-neutral/10 text-neutral-content rounded-full w-10 h-10 flex items-center justify-center overflow-hidden">

                                            @if ($service->icon)
                                                <img src="{{ asset('storage/' . $service->icon) }}"
                                                    alt="{{ $service->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span
                                                    class="font-bold text-neutral/70 uppercase">{{ substr($service->name, 0, 2) }}</span>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-base-content text-sm">{{ $service->name }}</div>
                                        <div class="text-xs text-base-content/60 truncate max-w-[250px] mt-0.5"
                                            title="{{ $service->description }}">
                                            {{ $service->description ?? 'Sin descripción' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="badge badge-sm border-none {{ $service->type === 'web' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }} font-medium px-2.5 py-3 rounded-md">
                                    {{ ucfirst($service->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-base-content/80 font-mono">
                                {{ $service->path }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('services.edit', $service) }}"
                                        class="btn btn-ghost btn-sm btn-square text-blue-600 hover:bg-blue-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?')"
                                            class="btn btn-ghost btn-sm btn-square text-red-600 hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-base-content/60">
                                No hay servicios registrados en la plataforma.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación Footer -->
        <div class="px-6 py-4 border-t border-base-200 bg-base-100 rounded-b-xl">
            {{ $services->links() }}
        </div>
    </div>
@endsection
