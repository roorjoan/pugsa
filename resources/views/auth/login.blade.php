@extends('layouts.auth')

@section('title', 'Iniciar Sesión')
@section('welcome_title', 'Bienvenido a la plataforma')
@section('welcome_text', 'Accede a tus herramientas y gestiona tu trabajo con la mejor experiencia de usuario.')

@section('content')
    <div class="bg-[#1a237e] text-white w-12 h-12 rounded-xl flex items-center justify-center mb-6 shadow-md">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
            </path>
        </svg>
    </div>

    <h2 class="text-3xl font-bold text-slate-800 mb-2">Iniciar Sesión</h2>
    <p class="text-sm text-slate-500 mb-8">Ingresa tus credenciales para acceder a tu cuenta.</p>

    <form action="{{ route('auth.login') }}" method="POST" class="space-y-5">
        @csrf
        <div class="form-control">
            <label class="label pb-1">
                <span class="label-text font-semibold text-slate-700">Correo Electrónico</span>
            </label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com"
                class="input input-bordered w-full h-12 rounded-xl bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all text-sm" />
            @error('email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control">
            <label class="label pb-1">
                <span class="label-text font-semibold text-slate-700">Contraseña</span>
            </label>
            <input type="password" name="password" placeholder="••••••••"
                class="input input-bordered w-full h-12 rounded-xl bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all text-sm tracking-widest" />
            @error('password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="btn bg-[#f44336] hover:bg-[#d32f2f] text-white border-none w-full h-12 rounded-xl text-base font-semibold mt-4 shadow-[0_4px_14px_0_rgba(244,67,54,0.39)] transition-all">
            Entrar a la cuenta
        </button>
    </form>

    <div class="mt-8 text-center">
        <p class="text-sm text-slate-500">
            ¿Aún no tienes una cuenta?
            <a href="{{ route('register') }}"
                class="text-[#1a237e] font-bold hover:underline inline-flex items-center gap-1">
                Regístrate aquí
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </p>
    </div>
@endsection
