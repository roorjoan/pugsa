<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Gestión de Roles</h1>

    @if (session('msg'))
        <div class="alert alert-success mb-4">{{ session('msg') }}</div>
    @endif

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h2 class="card-title mb-4">Crear Nuevo Rol</h2>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-control mb-4">
                    <label class="label"><span class="label-text font-semibold">Nombre del Rol</span></label>
                    <input type="text" name="name" class="input input-bordered w-full max-w-md" required />
                </div>

                <div class="mb-4">
                    <label class="label"><span class="label-text font-semibold">Asignar Permisos</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach ($permissions as $permission)
                            <label class="cursor-pointer label justify-start gap-2">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    class="checkbox checkbox-primary checkbox-sm" />
                                <span class="label-text">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Rol</button>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Rol</th>
                    <th>Permisos Asignados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td><span class="badge badge-neutral">{{ $role->name }}</span></td>
                        <td>
                            <div class="flex flex-wrap gap-1">
                                @forelse($role->permissions as $permission)
                                    <span class="badge badge-outline badge-sm">{{ $permission->name }}</span>
                                @empty
                                    <span class="text-gray-400 text-sm">Sin permisos</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="flex gap-2">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este rol?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>
</div>
