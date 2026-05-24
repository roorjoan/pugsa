<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // muestra la vista de login
    public function login()
    {
        // Si ya esta logeado 
        if (Auth::check()) {
            return to_route('dashboard');
        }

        return view('auth.login');
    }

    // muestra la vista de registro
    public function register()
    {
        // Si ya esta logeado 
        if (Auth::check()) {
            return to_route('dashboard');
        }

        return view('auth.register');
    }

    // crea un nuevo usuario
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        //asignar rol por defecto usuario
        $user->syncRoles('user');

        return to_route('auth.login')->with('msg', 'Usuario creado correctamente.');
    }

    // autentica al usuario
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

    // muestra la vista de dashboard
    public function index()
    {
        return view('dashboard');
    }

    // cierra la sesión del usuario
    public function logout()
    {
        Auth::logout();

        return to_route('auth.login')->with('msg', 'Sesión cerrada correctamente.');
    }
}
