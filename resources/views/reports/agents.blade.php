@extends('layouts.app')

@section('title', 'Reporte de Servicios')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Reporte de Servicios</h1>

        <form method="GET" class="flex gap-4 mb-8 bg-base-200 p-4 rounded-xl">
            <input type="date" name="start_date" value="{{ $startDate }}" class="input input-bordered" />
            <input type="date" name="end_date" value="{{ $endDate }}" class="input input-bordered" />
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <div class="card bg-base-100 shadow p-6 mb-8">
            <h2 class="font-bold mb-4">Uso de Servicios (%)</h2>
            <div class="space-y-4">
                @foreach ($stats as $serviceId => $percent)
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <!-- poner nombre del servicio -->
                            <span>Servicio {{ $serviceId }}</span>
                            <span>{{ number_format($percent, 1) }}%</span>
                        </div>
                        <div class="w-full bg-base-200 rounded-full h-4">
                            <div class="bg-primary h-4 rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto card bg-base-100 shadow p-6">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>SO</th>
                        <th>Navegador</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('d/m/y H:i') }}</td>
                        <td>{{ $log->os }}</td> {{-- Llama al método getOsAttribute --}}
                        <td>{{ $log->browser }}</td> {{-- Llama al método getBrowserAttribute --}}
                        <td>
                            <span class="badge {{ $log->tipo_acceso === 'Remoto' ? 'badge-warning' : 'badge-info' }}">
                                {{ $log->tipo_acceso }} {{-- Llama al método getTipoAccesoAttribute --}}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
