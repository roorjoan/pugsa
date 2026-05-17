<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--! favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <title>@yield('title') - UNE Granma</title>

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
                    <h1 class="text-lg font-semibold text-slate-400 dark:text-slate-500 hidden sm:block">
                        @yield('title')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Botón Tema Oscuro/Claro -->
                    {{-- !<button id="theme-toggle"
                        class="btn btn-circle btn-ghost btn-sm bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                        <svg id="theme-icon" class="w-5 h-5 text-slate-500 dark:text-slate-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Icono Luna (Por defecto en modo claro) -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                    </button>! --}}
                </div>
            </header>

            <!-- Área de contenido desplazable -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8 fade-in-up">
                @yield('content')
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
                            <a href="{{ route('dashboard') }}"
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
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Gestión de usuarios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Gestión de servicios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Gestión de roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Gestión de permisos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Logs de usuarios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Solicitud de cuentas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Chatbot de asistencia
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Reportes por fecha de acceso a los servicios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Servicios más utilizados
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Reportes de las solicitudes de cuentas del dominio
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1e293b] dark:bg-blue-600 text-white shadow-md font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Reportes gráficos
                            </a>
                        </li>
                    </ul>

                    <!-- Configuración -->
                    <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 tracking-wider mb-2">
                        REPORTES</p>
                    <ul class="space-y-1">
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
                                    <span>{{ strtoupper(substr(auth()->user()->name ?? 'No tiene nombre', 0, 1)) . strtoupper(substr(auth()->user()->name ?? 'No tiene nombre', -1)) }}</span>
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
</body>

</html>
