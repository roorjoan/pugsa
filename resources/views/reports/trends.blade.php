@extends('layouts.app')

@section('title', 'Tendencias de Uso')

@section('content')
    <div class="p-6">
        <div class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-6 mb-8">
            <form action="{{ route('reports.trends') }}" method="GET" class="flex flex-col md:flex-row gap-6 items-end">
                <div class="flex gap-4 w-full md:w-auto">
                    <div class="form-control w-full md:w-48">
                        <label class="label"><span class="label-text font-bold">Desde</span></label>
                        <input type="date" name="start_date" value="{{ request('start_date', is_string($startDate) ? $startDate : $startDate->format('Y-m-d')) }}" 
                               class="input input-bordered w-full" />
                    </div>
                    <div class="form-control w-full md:w-48">
                        <label class="label"><span class="label-text font-bold">Hasta</span></label>
                        <input type="date" name="end_date" value="{{ request('end_date', is_string($endDate) ? $endDate : $endDate->format('Y-m-d')) }}" 
                               class="input input-bordered w-full" />
                    </div>
                </div>
                <button type="submit" class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-8">
                    Generar Reporte
                </button>
            </form>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-extrabold text-base-content flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Tendencias de Uso
                </h2>
                <span class="badge badge-ghost badge-sm font-semibold text-xs">Top servicios</span>
            </div>

            <div class="space-y-6">
                @forelse ($trends as $trend)
                    <div class="group">
                        <div class="flex justify-between items-baseline mb-2">
                            <span class="font-semibold text-base-content group-hover:text-[#5b21b6] transition-colors">
                                {{ $trend->service->name }}
                            </span>
                            <span class="text-xs font-bold bg-base-200 px-2 py-0.5 rounded-md">
                                {{ $trend->total_usage }} <span class="text-base-content/50 font-normal">accesos</span>
                            </span>
                        </div>

                        <div class="w-full bg-base-200/50 h-3 rounded-full overflow-hidden shadow-inner">
                            <div class="bg-gradient-to-r from-[#5b21b6] to-[#7c3aed] h-full rounded-full transition-all duration-1000 ease-out"
                                style="width: {{ ($trend->total_usage / ($trends->first()->total_usage ?? 1)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-base-content/50 italic">
                        No se registraron accesos a servicios en el rango de fechas seleccionado.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection