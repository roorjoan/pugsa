@extends('layouts.app')

@section('title', 'Reporte de Auditoría')

@section('content')
    <div class="p-6">
        <div class="mb-8 pb-6 border-b border-base-300 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <h1 class="text-2xl font-bold text-base-content mb-1">Reporte de Auditoría y Seguridad</h1>
                <p class="text-sm text-base-content/60">Análisis exhaustivo del comportamiento de los usuarios y uso de
                    servicios.</p>
            </div>

            <form action="{{ route('reports.audit') }}" method="GET"
                class="flex flex-wrap items-end gap-3 bg-base-100 p-4 rounded-xl border border-base-200 shadow-sm">
                <div class="form-control">
                    <label class="label pb-1"><span class="label-text text-xs font-semibold">Desde</span></label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="input input-sm input-bordered bg-base-50" required />
                </div>
                <div class="form-control">
                    <label class="label pb-1"><span class="label-text text-xs font-semibold">Hasta</span></label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="input input-sm input-bordered bg-base-50" required />
                </div>
                <button type="submit"
                    class="btn btn-sm bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none shadow-sm px-6">
                    Generar Reporte
                </button>
            </form>
        </div>

        <div class="stats shadow-sm border border-base-200 w-full mb-8 bg-base-100 rounded-xl overflow-hidden">

            <div class="stat">
                <div class="stat-figure text-base-content/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div class="stat-title font-medium text-base-content/70">Usuarios Registrados</div>
                <div class="stat-value text-2xl">{{ number_format($totalUsers) }}</div>
                <div class="stat-desc text-base-content/50">Cuentas totales en PUGSA</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-[#5b21b6]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-title font-medium text-base-content/70">Usuarios Activos</div>
                <div class="stat-value text-2xl text-[#5b21b6]">{{ number_format($activeUsers) }}</div>
                <div class="stat-desc font-medium">Con accesos en este periodo</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-amber-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="stat-title font-medium text-base-content/70">Eventos de Auditoría</div>
                <div class="stat-value text-2xl">{{ number_format($totalEvents) }}</div>
                <div class="stat-desc text-base-content/50">Ejecuciones detectadas</div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-xl">
                <div class="card-body p-6">
                    <h2
                        class="text-sm font-bold tracking-wider text-base-content/50 uppercase mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01">
                            </path>
                        </svg>
                        Estadística de Interés: Servicio Principal
                    </h2>

                    @if ($topService)
                        <div class="flex items-center gap-4 bg-purple-50 p-4 rounded-lg border border-purple-100">
                            <div
                                class="w-12 h-12 rounded-lg bg-white shadow-sm flex items-center justify-center text-[#5b21b6]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-base-content">{{ $topService->name }}</h3>
                                <p class="text-sm text-base-content/60">{{ $topServiceCount }} accesos registrados en las
                                    fechas seleccionadas.</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6 text-sm text-base-content/50 italic">
                            No hay actividad de servicios en este periodo.
                        </div>
                    @endif
                </div>
            </div>

            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-xl">
                <div class="card-body p-6">
                    <h2
                        class="text-sm font-bold tracking-wider text-base-content/50 uppercase mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        Top Usuarios por Actividad
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="table table-sm w-full">
                            <thead>
                                <tr class="text-base-content/60">
                                    <th>Usuario</th>
                                    <th class="text-right">Interacciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topUsers as $user)
                                    <tr>
                                        <td class="font-medium text-sm">{{ $user->name }}</td>
                                        <td class="text-right">
                                            <span class="badge bg-base-200 text-xs font-bold">{{ $user->logs_count }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-xs text-base-content/50 italic">
                                            Sin registros de usuarios activos.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
