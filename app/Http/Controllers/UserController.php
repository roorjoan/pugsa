<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles:id,name')->paginate(10);
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * @param  \App\Http\Requests\User\CreateUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());
        // Asigna un rol por defecto al usuario
        $user->assignRole("user");

        return to_route('users.index')->with('msg', 'Usuario creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        //dd($roles);
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza un usuario en la base de datos.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        // Actualiza el rol del usuario al nuevo rol seleccionado
        $user->syncRoles($request->role);

        return to_route('users.index')->with('msg', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('msg', 'Usuario eliminado correctamente.');
    }
}
