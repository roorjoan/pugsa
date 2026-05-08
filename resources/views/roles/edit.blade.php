<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Rol: {{ $role->name }}</h1>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT') <div class="form-control mb-4">
                    <label class="label"><span class="label-text font-semibold">Nombre del Rol</span></label>
                    <input type="text" name="name" value="{{ $role->name }}"
                        class="input input-bordered w-full max-w-md" required />
                </div>

                <div class="mb-4">
                    <label class="label"><span class="label-text font-semibold">Asignar Permisos</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach ($permissions as $permission)
                            <label class="cursor-pointer label justify-start gap-2">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    class="checkbox checkbox-primary checkbox-sm"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} />
                                <span class="label-text">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
