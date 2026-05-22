<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; // <-- Importamos el modelo Permission

class RoleController extends Controller
{
    public function index()
    {
        // Eager loading de 'permissions' para que la tabla cargue rápido
        $roles = Role::with('permissions')->latest()->paginate(10);
        $permissions = Permission::all(); // Traemos los permisos para el formulario

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
            'permissions' => 'nullable|array', // Validamos que envíen un arreglo de permisos
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = Role::create(['name' => $validated['name']]);

        // Método recomendado por Spatie: Sincronizar permisos
        if ($request->has('permissions')) {
            $role->syncPermissions($validated['permissions']);
        }

        notify()
            ->success()
            ->title('Rol creado correctamente.')
            ->send();

        return to_route('roles.index');
    }

    // Nuevo método para mostrar el formulario de edición
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role->update(['name' => $validated['name']]);

        // syncPermissions quita los permisos que no estén en el array y añade los nuevos
        $role->syncPermissions($request->permissions ?? []);

        notify()
            ->success()
            ->title('Rol actualizado correctamente.')
            ->send();

        return to_route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        notify()
            ->success()
            ->title('Rol eliminado correctamente.')
            ->send();

        return to_route('roles.index');
    }
}
