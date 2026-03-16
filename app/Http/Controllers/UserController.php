<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function store(CreateUserRequest $request)
    {
        User::create($request->validated());

        return to_route('users.index');
    }
}
