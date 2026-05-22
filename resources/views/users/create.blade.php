@extends('layouts.app')

@section('title', 'Gestión de usuarios')

@section('content')
    <!-- Formulario de creación de usuario -->
    <div class="min-h-screen bg-base-200/50 p-4 flex flex-col justify-start items-start gap-6">
        <div class="border-b border-base-300 w-full pb-4 mb-2">
            <p class="text-sm text-base-content/60 mt-1">Registra una nueva cuenta en la plataforma.</p>
        </div>

        <div class="card w-full max-w-xl bg-base-100 shadow-sm border border-base-200">
            <div class="card-body gap-6">

                <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="name">
                            <span class="label-text font-medium">Nombre completo</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Ej. Juan Pérez"
                            class="input input-bordered w-full focus:input-primary transition-all @error('name') input-error @enderror"
                            value="{{ old('name') }}" />
                        @error('name')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="email">
                            <span class="label-text font-medium">Correo electrónico</span>
                        </label>
                        <input type="email" id="email" name="email" placeholder="juan.perez@empresa.com"
                            class="input input-bordered w-full focus:input-primary transition-all @error('email') input-error @enderror"
                            value="{{ old('email') }}" />
                        @error('email')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="password">
                            <span class="label-text font-medium">Contraseña</span>
                        </label>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            class="input input-bordered w-full focus:input-primary transition-all @error('password') input-error @enderror" />
                        @error('password')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="card-actions justify-end pt-4 border-t border-base-200 mt-6">
                        <a href="{{ route('users.index') }}" class="btn btn-ghost font-medium">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary px-6 font-semibold shadow-sm">
                            Crear usuario
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
