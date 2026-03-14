<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        User::create($request->validated());

        return to_route('auth.login');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function authLogin(LoginRequest $request)
    {
        // Intentamos autenticar al usuario
        if (Auth::attempt($request->validated())) {
            // Redirigimos a la ruta esperada por nuestro éxito
            return to_route('dashboard');
        }

        // Si falla, regresamos atrás con un error de validación
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function index()
    {
        return view(route('dashboard'));
    }

    public function logout()
    {
        Auth::logout();

        return to_route('auth.login');
    }
}
