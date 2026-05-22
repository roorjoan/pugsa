@extends('layouts.app')

@section('title', 'Gestión de Roles')

@section('content')
    <div class="p-4">
        <div class="mb-6 pb-4 border-b border-base-300">
            <h1 class="text-2xl font-bold text-base-content tracking-tight">Administra los roles y asigna permisos en la
                plataforma.</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <div class="card bg-base-100 shadow-sm border border-base-200 rounded-xl">
                <div class="card-body p-6 gap-4">
                    <h2 class="text-sm font-bold tracking-wider text-base-content/70 uppercase flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-[#5b21b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Crear Nuevo Rol
                    </h2>

                    <form action="{{ route('roles.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="form-control w-full">
                            <label class="label pb-1.5" for="name">
                                <span class="label-text font-medium text-base-content/80">Nombre del Rol</span>
                            </label>
                            <input type="text" id="name" name="name" required
                                class="input input-bordered w-full focus:input-primary transition-all text-sm @error('name') input-error @enderror"
                                placeholder="Ej. administrador, operador" value="{{ old('name') }}" />
                            @error('name')
                                <label class="label pt-1"><span
                                        class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label pb-1.5">
                                <span class="label-text font-medium text-base-content/80">Asignar Permisos</span>
                            </label>

                            <div
                                class="grid grid-cols-1 gap-1.5 max-h-52 overflow-y-auto p-3 bg-base-50 rounded-xl border border-base-200">
                                @foreach ($permissions as $permission)
                                    <label
                                        class="label cursor-pointer justify-start gap-3 hover:bg-base-200/50 p-2 rounded-lg transition-colors">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="checkbox checkbox-primary checkbox-sm rounded"
                                            {{ is_array(old('permissions')) && in_array($permission->name, old('permissions')) ? 'checked' : '' }} />
                                        <span
                                            class="label-text text-slate-700 text-xs font-medium">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('permissions')
                                <label class="label pt-1"><span
                                        class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none w-full font-semibold rounded-lg shadow-sm transition-colors">
                                Guardar Rol
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
                                <th class="py-4 px-6 w-16">ID</th>
                                <th class="py-4 px-6 w-1/4">Rol</th>
                                <th class="py-4 px-6">Permisos Asignados</th>
                                <th class="py-4 px-6 text-right w-28">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200/60">
                            @foreach ($roles as $role)
                                <tr class="hover:bg-base-200/20 transition-colors">
                                    <td class="py-4 px-6 text-xs font-mono text-base-content/50">
                                        {{ $role->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="badge font-bold px-2.5 py-1 text-xs rounded-md border-none bg-purple-50 text-purple-700 uppercase tracking-wide">
                                            {{ $role->name }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex flex-wrap gap-1 max-w-md">
                                            @forelse($role->permissions as $permission)
                                                <span
                                                    class="badge badge-sm bg-base-100 text-base-content/70 border border-base-300 font-medium rounded p-2">
                                                    {{ $permission->name }}
                                                </span>
                                            @empty
                                                <span class="text-base-content/30 text-xs italic font-medium">Sin permisos
                                                    asociados</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('roles.edit', $role) }}"
                                                class="btn btn-ghost btn-sm btn-square text-blue-600 hover:bg-blue-50 rounded-lg"
                                                title="Editar Rol">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('¿Estás completamente seguro que deseas eliminar este rol?');"
                                                    class="btn btn-ghost btn-sm btn-square text-red-600 hover:bg-red-50 rounded-lg"
                                                    title="Eliminar Rol">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($roles->hasPages())
                    <div class="px-6 py-4 border-t border-base-200 bg-base-50/50">
                        {{ $roles->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
