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

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        // Asigna un rol por defecto al usuario
        $user->assignRole("user");

        return to_route('users.index')->with('msg', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        //dd($roles);
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        // Actualiza el rol del usuario al nuevo rol seleccionado
        $user->syncRoles($request->role);

        return to_route('users.index')->with('msg', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('msg', 'Usuario eliminado correctamente.');
    }

    /*public function assignServices(User $user, Request $request)
    {
        $user->syncServices($request->services);
        return to_route('users.index')->with('msg', 'Servicios asignados correctamente.');
    }*/
}

