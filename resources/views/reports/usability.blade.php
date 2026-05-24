@extends('layouts.app')

@section('title', 'Usabilidad de Servicios')

@section('content')
    <div class="p-6">
        <div
            class="card bg-base-100 shadow-sm border border-base-200 rounded-2xl p-6 mb-8 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <h1 class="text-2xl font-extrabold text-base-content flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                    Usabilidad y Analítica
                </h1>
                <p class="text-sm text-base-content/60 mt-1">Reportes gráficos del comportamiento de usuarios en la
                    plataforma.</p>
            </div>

            <form action="{{ route('reports.usability') }}" method="GET"
                class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="form-control w-full sm:w-40">
                    <label class="label"><span
                            class="label-text font-bold text-xs uppercase text-base-content/70">Desde</span></label>
                    <input type="date" name="start_date" value="{{ request('start_date', $startDate) }}"
                        class="input input-sm input-bordered w-full" />
                </div>
                <div class="form-control w-full sm:w-40">
                    <label class="label"><span
                            class="label-text font-bold text-xs uppercase text-base-content/70">Hasta</span></label>
                    <input type="date" name="end_date" value="{{ request('end_date', $endDate) }}"
                        class="input input-sm input-bordered w-full" />
                </div>
                <button type="submit" class="btn btn-sm bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-6">
                    Generar Gráficos
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="card bg-base-100 shadow-xl border border-base-200 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-base-content mb-4">{{ $lineChart->options['chart_title'] }}</h2>
                <div class="w-full">
                    {!! $lineChart->renderHtml() !!}
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl border border-base-200 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-base-content mb-4">{{ $pieChart->options['chart_title'] }}</h2>
                <div class="w-full flex justify-center">
                    <div class="w-full max-w-sm">
                        {!! $pieChart->renderHtml() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        {!! $pieChart->renderChartJsLibrary() !!}
        {!! $lineChart->renderJs() !!}
        {!! $pieChart->renderJs() !!}
    @endpush
@endsection
