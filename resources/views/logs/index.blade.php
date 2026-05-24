@extends('layouts.app')

@section('title', 'Auditoría de Sistema')

@section('content')
    <div class="p-4">
        <div class="mb-6 pb-4 border-b border-base-300 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content mb-1">Auditoría y Logs</h1>
                <p class="text-sm text-base-content/60">Supervisa la actividad, los accesos y los eventos del sistema.</p>
            </div>

            <form action="{{ route('logs.index') }}" method="GET" class="flex items-end gap-2">
                <div class="form-control">
                    <label class="label pb-1" for="date">
                        <span class="label-text text-xs font-semibold text-base-content/70 uppercase tracking-wide">Fecha
                            específica</span>
                    </label>
                    <input type="date" id="date" name="date" value="{{ request('date') }}"
                        class="input input-sm input-bordered focus:input-primary transition-all bg-base-50" />
                </div>

                <button type="submit" class="btn btn-sm bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none shadow-sm">
                    Filtrar
                </button>

                @if (request('date'))
                    <a href="{{ route('logs.index') }}" class="btn btn-sm btn-ghost text-base-content/60"
                        title="Limpiar filtro">
                        Limpiar
                    </a>
                @endif
            </form>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-200 overflow-hidden rounded-xl">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead
                        class="bg-base-200/50 text-base-content/70 font-semibold tracking-wider text-xs uppercase border-b border-base-200">
                        <tr>
                            <th class="py-4 px-6">Usuario</th>
                            <th class="py-4 px-6">Dirección IP</th>
                            <th class="py-4 px-6">Servicio Accedido</th>
                            <th class="py-4 px-6">Evento</th>
                            <th class="py-4 px-6 text-right">Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-base-200/20 transition-colors">
                                <td class="py-3 px-6">
                                    @if ($log->user)
                                        <div class="flex items-center gap-3">
                                            <div class="avatar placeholder">
                                                <div
                                                    class="bg-base-200 text-base-content/70 font-bold rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-inner">
                                                    <span>{{ strtoupper(substr($log->user->name, 0, 2)) }}</span>
                                                </div>
                                            </div>
                                            <span
                                                class="font-semibold text-sm text-base-content">{{ $log->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-base-content/40 italic font-medium">Usuario
                                            eliminado/Sistema</span>
                                    @endif
                                </td>

                                <td class="py-3 px-6">
                                    <span
                                        class="font-mono text-xs bg-base-200/60 text-base-content/70 px-2 py-1 rounded border border-base-300/40">
                                        {{ $log->ip }}
                                    </span>
                                </td>

                                <td class="py-3 px-6">
                                    @if ($log->service)
                                        <span
                                            class="badge font-bold px-2.5 py-1 text-[10px] rounded-md border-none bg-purple-50 text-purple-700 uppercase tracking-wide">
                                            {{ $log->service->name }}
                                        </span>
                                    @else
                                        <span class="text-xs text-base-content/40 italic">N/A</span>
                                    @endif
                                </td>

                                <td class="py-3 px-6 text-sm text-base-content/80 font-medium">
                                    {{ $log->event_type }}
                                </td>

                                <td class="py-3 px-6 text-right text-xs text-base-content/60 font-medium">
                                    {{ $log->created_at->format('d/m/Y') }} <br>
                                    <span
                                        class="text-[10px] text-base-content/40">{{ $log->created_at->format('H:i:s') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="text-center py-12 text-base-content/40 text-sm italic bg-base-50/20">
                                    No se encontraron registros de auditoría para los parámetros seleccionados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($logs->hasPages())
                <div class="px-6 py-4 border-t border-base-200 bg-base-50/50">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
