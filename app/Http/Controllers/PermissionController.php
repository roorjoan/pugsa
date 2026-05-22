<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name|max:255'
        ]);

        Permission::create($validated);

        notify()
            ->success()
            ->title('Permiso creado correctamente.')
            ->send();

        return to_route('permissions.index');
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id
        ]);

        $permission->update($validated);

        notify()
            ->success()
            ->title('Permiso actualizado correctamente.')
            ->send();

        return to_route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        notify()
            ->success()
            ->title('Permiso eliminado correctamente.')
            ->send();

        return to_route('permissions.index');
    }
}
