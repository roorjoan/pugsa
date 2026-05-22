@extends('layouts.app')

@section('title', 'Control de Solicitudes de Cuenta')

@section('content')
    <div class="p-4">
        <div class="mb-6 pb-4 border-b border-base-300 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-base-content mb-1">Solicitudes de Cuentas de Dominio</h1>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-200 overflow-hidden rounded-xl">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead
                        class="bg-base-200/50 text-base-content/70 font-semibold tracking-wider text-xs uppercase border-b border-base-200">
                        <tr>
                            <th class="py-4 px-6 w-20">ID</th>
                            <th class="py-4 px-6">Usuario Solicitante</th>
                            <th class="py-4 px-6">Fecha Solicitud</th>
                            <th class="py-4 px-6 w-36">Estado</th>
                            <th class="py-4 px-6">Gestionado Por</th>
                            <th class="py-4 px-6 text-right w-36">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse ($requests as $request)
                            <tr class="hover:bg-base-200/20 transition-colors">
                                <td class="py-4 px-6 text-xs font-mono text-base-content/50">
                                    #{{ $request->id }}
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-semibold text-sm text-base-content">{{ $request->user->name }}</span>
                                        <span
                                            class="text-xs text-base-content/50 font-mono">{{ $request->user->email }}</span>
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-xs text-base-content/70 font-medium">
                                    {{ $request->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="py-4 px-6">
                                    @if ($request->status === 'pending')
                                        <span
                                            class="badge font-bold px-2.5 py-1 text-[11px] rounded-md border-none bg-amber-50 text-amber-700 uppercase tracking-wide">
                                            Pendiente
                                        </span>
                                    @elseif($request->status === 'approved')
                                        <span
                                            class="badge font-bold px-2.5 py-1 text-[11px] rounded-md border-none bg-emerald-50 text-emerald-700 uppercase tracking-wide">
                                            Aprobada
                                        </span>
                                    @else
                                        <span
                                            class="badge font-bold px-2.5 py-1 text-[11px] rounded-md border-none bg-rose-50 text-rose-700 uppercase tracking-wide">
                                            Rechazada
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-xs text-base-content/70 font-medium">
                                    {{ $request->approved_by ?? '—' }}
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        @if ($request->status === 'pending')
                                            <form action="{{ route('domain-requests.update', $request) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit"
                                                    onclick="return confirm('¿Confirmar la aprobación y asignación de cuenta para este usuario?')"
                                                    class="btn btn-ghost btn-sm btn-square text-emerald-600 hover:bg-emerald-50 rounded-lg"
                                                    title="Aprobar Solicitud">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </form>

                                            <form action="{{ route('domain-requests.update', $request) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit"
                                                    onclick="return confirm('¿Estás seguro que deseas rechazar esta solicitud de cuenta?')"
                                                    class="btn btn-ghost btn-sm btn-square text-rose-600 hover:bg-rose-50 rounded-lg"
                                                    title="Rechazar Solicitud">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="text-[11px] text-base-content/30 font-medium italic pr-2">Procesada</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center py-12 text-base-content/40 text-sm italic bg-base-50/20">
                                    No se registran solicitudes de cuentas de dominio en el sistema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (isset($requests) && $requests->hasPages())
                <div class="px-6 py-4 border-t border-base-200 bg-base-50/50">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
