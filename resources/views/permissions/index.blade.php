<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Gestión de Permisos</h1>

    @if (session('msg'))
        <div class="alert alert-success mb-4">{{ session('msg') }}</div>
    @endif

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h2 class="card-title">Crear Nuevo Permiso</h2>
            <form action="{{ route('permissions.store') }}" method="POST" class="flex gap-4 items-end">
                @csrf
                <div class="form-control w-full max-w-xs">
                    <label class="label"><span class="label-text">Nombre del Permiso</span></label>
                    <input type="text" name="name" class="input input-bordered w-full max-w-xs" required />
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td class="flex gap-2">
                            <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este permiso?');">
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
            {{ $permissions->links() }}
        </div>
    </div>
</div>
