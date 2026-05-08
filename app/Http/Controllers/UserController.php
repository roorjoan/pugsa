<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles:id,name')->paginate(1);
        return view('users.index', compact('users', 'roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->syncRoles($request->role_id);/* Asigna el rol al usuario */

        return to_route('users.index')->with('msg', 'Usuario creado correctamente.');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->validated());
        $user->syncRoles($request->role_id);/* Asigna el rol al usuario */

        return to_route('users.index')->with('msg', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('msg', 'Usuario eliminado correctamente.');
    }

    public function assignServices(User $user, Request $request)
    {
        $user->syncServices($request->services);
        return to_route('users.index')->with('msg', 'Servicios asignados correctamente.');
    }

    // Asigna un rol a un usuario 
    public function assignRole(User $user, Request $request)
    {
        $user->syncRoles($request->role);
        return to_route('users.index')->with('msg', 'Role asignado correctamente.');
    }
}
