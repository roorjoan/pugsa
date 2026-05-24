@extends('layouts.app')

@section('title', 'Solicitudes de Cuentas de Dominio')

@section('content')
    <div class="p-6">
        <div class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-6 mb-8 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <h1 class="text-2xl font-extrabold text-base-content flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                        </path>
                    </svg>
                    Gestión de Cuentas de Dominio
                </h1>
                <p class="text-sm text-base-content/60 mt-1">Estadísticas y registro de solicitudes de acceso a la red.</p>
            </div>

            <form action="{{ route('reports.domain_requests') }}" method="GET"
                class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="form-control w-full sm:w-40">
                    <label class="label"><span
                            class="label-text font-bold text-xs uppercase text-base-content/70">Desde</span></label>
                    <input type="date" name="start_date"
                        value="{{ request('start_date', is_string($startDate) ? $startDate : $startDate->format('Y-m-d')) }}"
                        class="input input-sm input-bordered w-full" />
                </div>
                <div class="form-control w-full sm:w-40">
                    <label class="label"><span
                            class="label-text font-bold text-xs uppercase text-base-content/70">Hasta</span></label>
                    <input type="date" name="end_date"
                        value="{{ request('end_date', is_string($endDate) ? $endDate : $endDate->format('Y-m-d')) }}"
                        class="input input-sm input-bordered w-full" />
                </div>
                <button type="submit" class="btn btn-sm bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-6">
                    Filtrar
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-5">
                <div class="text-base-content/50 text-xs font-bold uppercase tracking-wider mb-2">Total Solicitudes</div>
                <div class="text-3xl font-extrabold text-base-content">{{ $stats['total'] }}</div>
            </div>
            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-5 border-l-4 border-l-success">
                <div class="text-base-content/50 text-xs font-bold uppercase tracking-wider mb-2">Aprobadas / Creadas</div>
                <div class="text-3xl font-extrabold text-success">{{ $stats['approved'] }}</div>
            </div>
            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-5 border-l-4 border-l-warning">
                <div class="text-base-content/50 text-xs font-bold uppercase tracking-wider mb-2">En Revisión</div>
                <div class="text-3xl font-extrabold text-warning">{{ $stats['pending'] }}</div>
            </div>
            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-5 border-l-4 border-l-error">
                <div class="text-base-content/50 text-xs font-bold uppercase tracking-wider mb-2">Rechazadas</div>
                <div class="text-3xl font-extrabold text-error">{{ $stats['rejected'] }}</div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-200 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-base-200/50 text-base-content/70 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="py-4 px-6">ID / Solicitante</th>
                            <th class="py-4 px-6 text-center">Rol</th>
                            <th class="py-4 px-6 text-center">Estado</th>
                            <th class="py-4 px-6 text-right">Fecha de Solicitud</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse ($requestsList as $requestLog)
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td class="py-3 px-6">
                                    <div class="font-semibold text-sm">
                                        {{ $requestLog->user->name ?? 'Usuario Desconocido' }}</div>
                                    <div class="text-xs text-base-content/50">
                                        #REQ-{{ str_pad($requestLog->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td class="py-3 px-6">
                                    <div class="text-xs text-base-content/50">{{ $requestLog->user->roles->first()->name ?? 'No tiene rol' }}</div>
                                </td>
                                
                                <td class="py-3 px-6 text-center">
                                    @if ($requestLog->status === 'approved')
                                        <span class="badge badge-success badge-sm font-bold text-white">Aprobada</span>
                                    @elseif($requestLog->status === 'pending')
                                        <span class="badge badge-warning badge-sm font-bold text-white">Pendiente</span>
                                    @else
                                        <span class="badge badge-error badge-sm font-bold text-white">Rechazada</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-right text-sm">
                                    {{ $requestLog->created_at->format('d/m/Y') }}<br>
                                    <span
                                        class="text-xs text-base-content/40">{{ $requestLog->created_at->format('H:i') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-base-content/50 italic bg-base-50/30">
                                    No se encontraron solicitudes de dominio en el rango de fechas seleccionado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($requestsList->hasPages())
                <div class="px-6 py-4 border-t border-base-200 bg-base-50/50">
                    {{ $requestsList->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection