<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - UNE Granma</title>

    {{-- Adicionamos vite para que compile los archivos de tailwind, daisyui y livewire --}}
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>
    Dashboard
    @auth
        <p>{{ Auth::user()->name }}</p>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Cerrar Sesión</button>
        </form>
    @endauth
    @can('listar servicios')
        <p>Servicios</p>
    @endcan
    @can('listar roles')
        <p>Roles</p>
    @endcan
</body>

</html>
