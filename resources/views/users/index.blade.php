<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - PUGSA</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Habilitamos la estrategia de clases para el modo oscuro
        }
    </script>

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            /* slate-100 */
        }

        /* Para modo oscuro */
        html.dark body {
            background-color: #0f172a;
            /* slate-900 */
        }

        /* Animación de entrada sutil para el contenido principal */
        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilos personalizados para scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        html.dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }
    </style>

</head>

<body class="text-slate-600 dark:text-slate-400 antialiased transition-colors duration-300">

    <!-- Layout principal usando Drawer de DaisyUI para responsividad -->
    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />

        <!-- Contenido Principal -->
        <div class="drawer-content flex flex-col h-screen overflow-hidden">

            <!-- Barra de navegación superior -->
            <header
                class="h-16 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-4 lg:px-8 z-10 shrink-0 transition-colors duration-300">
                <div class="flex items-center gap-4">
                    <h1 class="text-lg font-semibold text-slate-400 dark:text-slate-500 hidden sm:block">Gestión de
                        Usuarios</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Botón Tema Oscuro/Claro -->
                    <button id="theme-toggle"
                        class="btn btn-circle btn-ghost btn-sm bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                        <svg id="theme-icon" class="w-5 h-5 text-slate-500 dark:text-slate-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Icono Luna (Por defecto en modo claro) -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Área de contenido desplazable -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8 fade-in-up">
                <div class="max-w-6xl mx-auto">

                    <!-- Cabecera de la página -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-white transition-colors">
                            Administra los usuarios del sistema</h2>

                        <!-- Boton que abre el modal de creacion de usuario -->
                        <button onclick="createModal.showModal()"
                            class="btn bg-[#f05252] hover:bg-[#d94444] text-white border-none rounded-lg px-6 shadow-md shadow-red-200 dark:shadow-none font-semibold gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Nuevo Usuario
                        </button>
                    </div>

                    <!-- Tarjeta de la Tabla -->
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden transition-colors duration-300">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <!-- Encabezado de tabla -->
                                <thead
                                    class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 uppercase text-xs tracking-wider transition-colors duration-300">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold">Usuario</th>
                                        <th class="px-6 py-4 font-semibold">Contacto</th>
                                        <th class="px-6 py-4 font-semibold">Rol</th>
                                        <th class="px-6 py-4 font-semibold">Acceso</th>
                                        <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <!-- Cuerpo de la tabla -->
                                <tbody
                                    class="divide-y divide-slate-100 dark:divide-slate-700 text-sm transition-colors duration-300">
                                    @foreach ($users as $user)
                                        <!-- Fila 1 -->
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="avatar placeholder">
                                                        <div
                                                            class="bg-[#1e3a8a] text-white rounded-full w-10 h-10 font-bold">
                                                            <!-- Generar dos letras aleatorias en mayusculas -->
                                                            <span>{{ strtoupper(substr($user->name, 0, 1)) . strtoupper(substr($user->name, -1)) }}</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="font-bold text-slate-800 dark:text-slate-200 text-base">
                                                            {{ $user->name }}</div>
                                                        <div class="text-xs text-slate-400">
                                                            {{ $user->created_at->diffForHumans() }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300 font-medium">
                                                {{ $user->email }}</td>
                                            <td class="px-6 py-4">
                                                @foreach ($user->roles as $role)
                                                    <span
                                                        class="badge bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300 font-bold border-none px-3 py-3 rounded-md text-xs">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            {{-- aqui va un boton naranja con el nombre "Asignar rol" que abre un modal para asignar el rol al usuario --}}
                                            <td class="px-6 py-4">
                                                <button onclick="roleModal.showModal()"
                                                    class="btn btn-warning btn-sm text-white hover:bg-warning/80 mr-1 px-3">
                                                    Asignar rol
                                                </button>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button onclick="editModal.showModal()"
                                                    class="btn btn-ghost btn-sm btn-square text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 mr-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                {{-- aqui va un link con forma de papelera para eliminar el usuario, no modal --}}
                                                <a href="{{ route('users.destroy', $user->id) }}"
                                                    onclick="return confirm('¿Estas seguro de eliminar este usuario?')"
                                                    class="btn btn-ghost btn-sm btn-square text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 mr-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación Footer -->
                        <div
                            class="bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 px-6 py-4 flex flex-col sm:flex-row items-right justify-between gap-4 transition-colors duration-300">
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium items-right">
                            </p>
                            <div class="join items-left">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Barra Lateral (Sidebar) -->
        <aside
            class="drawer-side z-20 border-r border-slate-200 dark:border-slate-700 shadow-sm transition-colors duration-300">
            <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div
                class="menu p-0 w-64 min-h-full bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 flex flex-col transition-colors duration-300">

                <!-- Logo -->
                <div class="h-20 flex items-center px-6 mb-4">
                    <div
                        class="flex items-center gap-3 text-[#1e3a8a] dark:text-blue-400 font-bold text-xl tracking-wide">
                        <div class="bg-[#1e3a8a] dark:bg-blue-500 text-white p-1.5 rounded-lg shadow-sm">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M21 16.5C21 16.88 20.79 17.21 20.47 17.38L12.57 21.82C12.22 22.02 11.78 22.02 11.43 21.82L3.53 17.38C3.21 17.21 3 16.88 3 16.5V7.5C3 7.12 3.21 6.79 3.53 6.62L11.43 2.18C11.78 1.98 12.22 1.98 12.57 2.18L20.47 6.62C20.79 6.79 21 7.12 21 7.5V16.5ZM12 4.15L5.6 7.71L12 11.27L18.4 7.71L12 4.15ZM4.5 15.65L11.25 19.41V12.35L4.5 8.59V15.65ZM19.5 15.65V8.59L12.75 12.35V19.41L19.5 15.65Z">
                                </path>
                            </svg>
                        </div>
                        PUGSA
                    </div>
                </div>

                <!-- Menú Principal -->
                <div class="px-4 flex-1">
                    <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 tracking-wider mb-2">MENÚ
                        PRINCIPAL</p>
                    <ul class="space-y-1 mb-8">
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-300 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Usuarios
                            </a>
                        </li>
                    </ul>

                    <!-- Configuración -->
                    <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 tracking-wider mb-2">
                        CONFIGURACIÓN</p>
                    <ul class="space-y-1">
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-300 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Ajustes
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-300 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Reportes
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Perfil de Usuario Footer -->
                <div class="p-4 mt-auto">
                    <div
                        class="bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 p-3 rounded-2xl flex items-center justify-between shadow-sm transition-colors duration-300">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div
                                    class="bg-[#1e3a8a] dark:bg-blue-500 text-white rounded-full w-9 h-9 font-bold text-sm">
                                    <!-- Generar dos letras aleatorias en mayusculas -->
                                    <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) . strtoupper(substr(auth()->user()->name, -1)) }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span
                                    class="text-sm font-bold text-slate-800 dark:text-white">{{ auth()->user()->name ?? 'No tiene nombre' }}</span>
                                <span
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-300 tracking-wider uppercase">{{ auth()->user()->roles[0]->name ?? 'No tiene rol' }}</span>
                            </div>
                        </div>
                        <!-- Botón de Cerrar Sesión, envia a la ruta logout -->
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button
                                class="text-[#f05252] hover:bg-red-50 dark:hover:bg-slate-600 p-2 rounded-lg transition-colors"
                                title="Cerrar sesión">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
        </aside>
    </div>

    <!-- ========================================== -->
    <!-- MODAL: CREAR USUARIO -->
    <!-- ========================================== -->
    <dialog id="createModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            {{-- Formulario para crear un nuevo usuario --}}
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nombre</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" placeholder="Nombre">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered" placeholder="Email">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered" placeholder="Password">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Rol</span>
                    </label>
                    <select name="role_id" class="select select-bordered">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control flex justify-end">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </dialog>


    <!-- ========================================== -->
    <!-- MODAL: EDITAR USUARIO -->
    <!-- ========================================== -->
    <dialog id="editModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            {{-- Formulario para editar un usuario --}}
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nombre</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered" placeholder="Nombre">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered" placeholder="Email">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered" placeholder="Password">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Rol</span>
                    </label>
                    <select name="role_id" class="select select-bordered">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- ========================================== -->
    <!-- MODAL: ASIGNAR ROL -->
    <!-- ========================================== -->
    <dialog id="roleModal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            {{-- Formulario para asignar un rol a un usuario --}}
            <form action="{{ route('users.assignRole', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Rol</span>
                    </label>
                    <select name="role_id" class="select select-bordered">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control">
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </dialog>


    <script>
        // ======= Lógica de Cambio de Tema (Modo Claro/Oscuro) =======
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        // SVGs para los iconos del sol y luna
        const sunIconPath =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
        const moonIconPath =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';

        //Modo oscuro por defecto
        document.addEventListener('DOMContentLoaded', () => {
            htmlElement.setAttribute('data-theme', 'dark');
            htmlElement.classList.add('dark'); // Añade la clase dark para Tailwind
            themeIcon.innerHTML = sunIconPath; // Cambia icono a sol
        });

        //Funcionalidad del botón de cambio de tema
        themeToggleBtn.addEventListener('click', () => {
            if (htmlElement.getAttribute('data-theme') === 'dark') {
                htmlElement.setAttribute('data-theme', 'light');
                htmlElement.classList.remove('dark'); // Elimina la clase dark para Tailwind
                themeIcon.innerHTML = moonIconPath; // Cambia icono a luna
            } else {
                htmlElement.setAttribute('data-theme', 'dark');
                htmlElement.classList.add('dark'); // Elimina la clase dark para Tailwind
                themeIcon.innerHTML = sunIconPath; // Cambia icono a sol
            }
        });
    </script>
</body>

</html>
