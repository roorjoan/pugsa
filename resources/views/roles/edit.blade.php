@extends('layouts.app')

@section('title', 'Editar Rol')

@section('content')
    <div class="p-4">
        <div class="mb-6 pb-4 border-b border-base-300">
            <h1 class="text-2xl font-bold text-base-content tracking-tight">Modifica los privilegios del rol en el sistema.</h1>
        </div>

        <div class="card bg-base-100 shadow-sm max-w-2xl border border-base-200 rounded-xl">
            <div class="card-body gap-5 p-8">

                <div class="flex items-center gap-3 mb-2 border-b border-base-100 pb-3">
                    <h2 class="text-base font-bold text-base-content/80">Editar Rol:</h2>
                    <span
                        class="badge font-bold px-2.5 py-1 text-xs rounded-md border-none bg-purple-50 text-purple-700 uppercase tracking-wide">
                        {{ $role->name }}
                    </span>
                </div>

                <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="name">
                            <span class="label-text font-medium text-base-content/80">Nombre del Rol</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            class="input input-bordered w-full focus:input-primary transition-all text-sm @error('name') input-error @enderror"
                            value="{{ old('name', $role->name) }}" placeholder="Ej. administrador, operador" />
                        @error('name')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5">
                            <span class="label-text font-medium text-base-content/80">Permisos Asignados al Rol</span>
                        </label>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-56 overflow-y-auto p-3 bg-base-50 rounded-xl border border-base-200">
                            @foreach ($permissions as $permission)
                                <label
                                    class="label cursor-pointer justify-start gap-3 hover:bg-base-200/50 p-2 rounded-lg transition-colors">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="checkbox checkbox-primary checkbox-sm rounded"
                                        {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }} />
                                    <span
                                        class="label-text text-slate-700 text-xs font-medium">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>

                        @error('permissions')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-base-100 mt-8">
                        <a href="{{ route('roles.index') }}"
                            class="text-base-content/70 hover:text-base-content font-medium text-sm px-4 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-6 font-semibold shadow-sm rounded-lg transition-colors">
                            Actualizar Rol
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
