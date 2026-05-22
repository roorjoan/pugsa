@extends('layouts.app')

@section('title', 'Gestión de Permisos')

@section('content')
    <div class="p-4">
        <div class="mb-6 pb-4 border-b border-base-300">
            <h1 class="text-2xl font-bold text-base-content tracking-tight">Administra y registra los permisos del
                sistema en la plataforma.</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-xl">
                <div class="card-body p-6 gap-4">
                    <h2 class="text-sm font-bold tracking-wider text-base-content/70 uppercase flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        Crear Nuevo Permiso
                    </h2>

                    <form action="{{ route('permissions.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="form-control w-full">
                            <label class="label pb-1.5" for="name">
                                <span class="label-text font-medium text-base-content/80">Nombre del Permiso</span>
                            </label>
                            <input type="text" id="name" name="name" required
                                class="input input-bordered w-full focus:input-primary transition-all text-sm @error('name') input-error @enderror"
                                placeholder="Ej. listar usuarios, eliminar permiso, ..." value="{{ old('name') }}" />
                            @error('name')
                                <label class="label pt-1"><span
                                        class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none w-full font-semibold rounded-lg shadow-sm transition-colors">
                                Guardar Permiso
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2 card bg-base-100 shadow-sm border border-base-200 overflow-hidden rounded-xl">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead
                            class="bg-base-200/50 text-base-content/70 font-semibold tracking-wider text-xs uppercase border-b border-base-200">
                            <tr>
                                <th class="py-4 px-6 w-24">ID</th>
                                <th class="py-4 px-6">Nombre del Permiso</th>
                                <th class="py-4 px-6 text-right w-28">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200/60">
                            @forelse ($permissions as $permission)
                                <tr class="hover:bg-base-200/20 transition-colors">
                                    <td class="py-4 px-6 text-xs font-mono text-base-content/50">
                                        #{{ $permission->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="font-mono text-xs bg-base-200/60 text-base-content/80 px-2 py-1 rounded-md border border-base-300/40">
                                            {{ $permission->name }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end">
                                            <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('¿Estás completamente seguro que deseas eliminar este permiso? Esto podría afectar a los roles asignados.');"
                                                    class="btn btn-ghost btn-sm btn-square text-red-600 hover:bg-red-50 rounded-lg"
                                                    title="Eliminar Permiso">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
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
                                    <td colspan="3" class="text-center py-8 text-base-content/40 text-sm italic">
                                        No hay permisos registrados en el sistema actualmente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($permissions->hasPages())
                    <div class="px-6 py-4 border-t border-base-200 bg-base-50/50">
                        {{ $permissions->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
