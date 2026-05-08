@extends('layouts.auth')

@section('title', 'Crear Cuenta')
@section('flex_direction', 'md:flex-row-reverse') {{-- Invierte el orden para el registro --}}
@section('welcome_title', 'Únete al equipo')
@section('welcome_text', 'Regístrate en segundos y obtén acceso a nuestras herramientas.')

@section('content')
    <div class="bg-[#1a237e] text-white w-12 h-12 rounded-xl flex items-center justify-center mb-6 shadow-md">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
        </svg>
    </div>

    <h2 class="text-3xl font-bold text-slate-800 mb-2">Crear una cuenta</h2>
    <p class="text-sm text-slate-500 mb-6">Completa tus datos para empezar a utilizar la plataforma.</p>

    <form action="{{ route('auth.register') }}" method="POST" class="space-y-4">
        @csrf
        <div class="form-control">
            <label class="label pb-1">
                <span class="label-text font-semibold text-slate-700">Nombre Completo</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Juan Pérez"
                class="input input-bordered w-full h-12 rounded-xl bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all text-sm" />
            @error('name')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

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
            class="btn bg-[#f44336] hover:bg-[#d32f2f] text-white border-none w-full h-12 rounded-xl text-base font-semibold mt-2 shadow-[0_4px_14px_0_rgba(244,67,54,0.39)] transition-all">
            Registrarse ahora
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}"
                class="text-[#1a237e] font-bold hover:underline inline-flex items-center gap-1">
                Inicia sesión aquí
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </p>
    </div>
@endsection
