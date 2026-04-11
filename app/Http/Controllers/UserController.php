<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('services')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function store(CreateUserRequest $request)
    {
        User::create($request->validated());

        return to_route('users.index')->with('msg', 'Usuario creado correctamente.');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        $user->update($request->validated());

        return to_route('users.index')->with('msg', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('msg', 'Usuario eliminado correctamente.');
    }
}
