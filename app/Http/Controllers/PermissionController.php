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

        return to_route('permissions.index')->with('msg', 'Permiso creado correctamente.');
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id
        ]);

        $permission->update($validated);

        return to_route('permissions.index')->with('msg', 'Permiso actualizado correctamente.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return to_route('permissions.index')->with('msg', 'Permiso eliminado correctamente.');
    }
}
