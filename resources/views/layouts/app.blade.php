<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - UNE Granma</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Add Laravel Notify CSS -->
    @notifyCss
</head>

<body class="text-slate-600 antialiased transition-colors duration-300">
    <!-- Add notification component -->
    <x-notify::notify />

    <!-- Layout principal usando Drawer de DaisyUI para responsividad -->
    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />

        <!-- Contenido Principal -->
        <div class="drawer-content flex flex-col h-screen overflow-hidden">

            <!-- Barra de navegación superior -->
            <header
                class="h-16 bg-slate-50 border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 z-10 shrink-0 transition-colors duration-300">
                <div class="flex items-center gap-4">
                    <h1 class="text-lg font-semibold text-slate-400 hidden sm:block">
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
        <aside class="drawer-side z-20 border-r border-slate-200 shadow-sm transition-colors duration-300">
            <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div
                class="menu p-0 w-64 min-h-full bg-slate-50 text-slate-600 flex flex-col transition-colors duration-300">

                <!-- Logo -->
                <div class="h-20 flex items-center px-6 mb-4">
                    <div class="flex items-center gap-3 text-[#1e3a8a] font-bold text-xl tracking-wide">
                        <div class="bg-[#1e3a8a] text-white p-1.5 rounded-lg shadow-sm">
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
                    <p class="px-4 text-xs font-bold text-slate-400 tracking-wider mb-2">MENÚ
                        PRINCIPAL</p>
                    <ul class="space-y-1 mb-8">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
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
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Gestión de usuarios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg width="24px" height="24px" viewBox="0 0 48 48" id="a"
                                    xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000"
                                    stroke-width="2.4">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <defs>
                                            <style>
                                                .b {
                                                    fill: none;
                                                    stroke: #000000;
                                                    stroke-linecap: round;
                                                    stroke-linejoin: round;
                                                }
                                            </style>
                                        </defs>
                                        <circle class="b" cx="9.379" cy="9.379" r="3.879"></circle>
                                        <circle class="b" cx="9.379" cy="38.621" r="3.879"></circle>
                                        <circle class="b" cx="9.379" cy="24" r="3.879"></circle>
                                        <rect class="b" x="17.4355" y="5.5" width="25.0645" height="7.7581"
                                            rx="1.7903" ry="1.7903"></rect>
                                        <rect class="b" x="17.4355" y="34.7419" width="25.0645" height="7.7581"
                                            rx="1.7903" ry="1.7903"></rect>
                                        <rect class="b" x="17.4355" y="20.121" width="25.0645" height="7.7581"
                                            rx="1.7903" ry="1.7903"></rect>
                                    </g>
                                </svg>
                                Gestión de servicios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('roles.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg fill="#303130" width="24px" height="24px" viewBox="0 0 1920 1920"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#303130"
                                    stroke-width="0.019200000000000002">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M1707 1760c0 29.44-23.893 53.333-53.333 53.333h-320c-29.44 0-53.334-23.893-53.334-53.333v-266.667H1707V1760ZM213.667 1484.053V1337.6c0-86.613 56.426-162.133 140.48-187.947 182.826-56 373.12-82.24 562.346-82.986 146.88.746 292.8 19.413 436.267 54.4-44.053 39.04-72.427 95.466-72.427 158.933v106.667h-106.666v288.32c-87.467 20.266-176.96 31.68-266.667 31.68-144.427 0-423.467-29.334-693.333-222.614ZM1387 1280c0-58.773 47.893-106.667 106.667-106.667 58.773 0 106.666 47.894 106.666 106.667v106.667H1387V1280ZM899.533 106.667h14.934c174.08 0 322.346 122.56 357.653 290.24-30.187 17.493-61.44 29.76-115.52 29.76-69.547 0-101.12-19.947-141.227-45.227-45.653-28.8-97.28-61.44-196.906-61.44-100.374 0-152.32 32.747-198.187 61.653-26.773 16.96-49.813 31.467-82.987 39.147 25.28-177.28 178.134-314.133 362.24-314.133Zm807.467 1280V1280c0-61.653-26.667-116.8-68.587-155.733l.107-.107c-37.867-43.733-123.093-69.76-146.88-76.267-100.373-30.826-202.88-53.013-306.453-67.626C1306.893 894.72 1387 753.813 1387 594.133h-106.667c0 201.707-164.16 365.867-365.866 365.867h-14.934c-201.706 0-365.866-164.16-365.866-365.867v-64.32c66.24-9.173 106.88-34.773 143.573-57.92 40.107-25.28 71.787-45.226 141.227-45.226 68.693 0 100.16 19.84 139.946 45.013 45.867 28.907 97.814 61.653 198.187 61.653 100.373 0 152.533-33.066 202.453-64.746l28.267-18.027-3.84-33.28C1355.427 179.413 1153.72 0 914.467 0h-14.934C638.947 0 427 211.947 427 480v114.133c0 159.787 80.107 300.694 201.92 386.24-103.36 14.507-205.653 36.587-306.133 67.307C193.72 1087.36 107 1203.84 107 1337.6v200.213l21.333 15.894C429.453 1779.627 745.4 1813.333 907 1813.333c90.453 0 180.48-11.52 268.907-30.506 11.306 77.333 77.333 137.173 157.76 137.173h320c88.213 0 160-71.787 160-160v-373.333H1707Z"
                                            fill-rule="evenodd"></path>
                                    </g>
                                </svg>
                                Gestión de roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permissions.index') }}"
                                class="flex items-center gap-3 px-2 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg width="26px" height="26px" viewBox="0 0 48.00 48.00" id="b"
                                    xmlns="http://www.w3.org/2000/svg" fill="#3e3e3e" stroke="#3e3e3e"
                                    stroke-width="0.00048000000000000007" transform="rotate(0)">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="2.88">
                                        <defs>
                                            <style>
                                                .c {
                                                    fill: none;
                                                    stroke: #3e3e3e;
                                                    stroke-linecap: round;
                                                    stroke-linejoin: round;
                                                }
                                            </style>
                                        </defs>
                                        <path class="c"
                                            d="m28.9722,19.4677c4.1332,0,7.4838-3.3506,7.4838-7.4838s-3.3506-7.4838-7.4838-7.4838-7.4838,3.3506-7.4838,7.4838">
                                        </path>
                                        <path class="c"
                                            d="m36.7621,19.4677c0-4.3022-3.4877-7.7898-7.7899-7.7898s-7.7897,3.4876-7.7897,7.7898c0,3.3055,2.0669,6.1128,4.9722,7.2441v13.1419l2.8175,3.6463,2.8177-3.6463v-13.1419c2.9054-1.1313,4.9722-3.9386,4.9722-7.2441Z">
                                        </path>
                                        <path class="c"
                                            d="m19.5872,24.8336l-7.7633,7.7633-.586,4.5706,4.5707-.5859,7.7633-7.7633">
                                        </path>
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <defs>
                                            <style>
                                                .c {
                                                    fill: none;
                                                    stroke: #3e3e3e;
                                                    stroke-linecap: round;
                                                    stroke-linejoin: round;
                                                }
                                            </style>
                                        </defs>
                                        <path class="c"
                                            d="m28.9722,19.4677c4.1332,0,7.4838-3.3506,7.4838-7.4838s-3.3506-7.4838-7.4838-7.4838-7.4838,3.3506-7.4838,7.4838">
                                        </path>
                                        <path class="c"
                                            d="m36.7621,19.4677c0-4.3022-3.4877-7.7898-7.7899-7.7898s-7.7897,3.4876-7.7897,7.7898c0,3.3055,2.0669,6.1128,4.9722,7.2441v13.1419l2.8175,3.6463,2.8177-3.6463v-13.1419c2.9054-1.1313,4.9722-3.9386,4.9722-7.2441Z">
                                        </path>
                                        <path class="c"
                                            d="m19.5872,24.8336l-7.7633,7.7633-.586,4.5706,4.5707-.5859,7.7633-7.7633">
                                        </path>
                                    </g>
                                </svg>
                                Gestión de permisos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('domain-requests.create') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg fill="#4c4c4c" width="24px" height="24px" viewBox="0 0 64 64"
                                    id="Layer_1_1_" version="1.1" xml:space="preserve"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    stroke="#4c4c4c">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M60,3h-9.184C50.402,1.839,49.302,1,48,1H34c-1.302,0-2.402,0.839-2.816,2H22c-1.654,0-3,1.346-3,3v13h-3.406 c-1.217,0-2.418,0.319-3.474,0.923L6.734,23H1v18h6.697l4.236,2.824C13.087,44.594,14.43,45,15.816,45H19v15c0,1.654,1.346,3,3,3 h38c1.654,0,3-1.346,3-3V6C63,4.346,61.654,3,60,3z M25,27h2c2.206,0,4-1.794,4-4s-1.794-4-4-4h-2V9h6.184 c0.414,1.161,1.514,2,2.816,2h14c1.302,0,2.402-0.839,2.816-2H57v48H25V27z M33,4c0-0.552,0.448-1,1-1h14c0.552,0,1,0.448,1,1v4 c0,0.552-0.448,1-1,1H34c-0.552,0-1-0.448-1-1V4z M21,6c0-0.552,0.448-1,1-1h9v2h-8v12h-2V6z M15.816,43 c-0.99,0-1.949-0.29-2.773-0.84L8.303,39H3V25h4.266l5.847-3.341C13.867,21.228,14.725,21,15.594,21H27c1.103,0,2,0.897,2,2 s-0.897,2-2,2H15v1c0,2.757-2.243,5-5,5v2c3.521,0,6.442-2.612,6.929-6H19v16H15.816z M61,60c0,0.552-0.448,1-1,1H22 c-0.552,0-1-0.448-1-1V27h2v32h36V7h-8V5h9c0.552,0,1,0.448,1,1V60z">
                                            </path>
                                            <rect height="2" width="2" x="35" y="5"></rect>
                                            <rect height="2" width="2" x="45" y="5"></rect>
                                            <path
                                                d="M48.373,47.209l-3.375-0.964l-0.001-0.507C46.81,44.472,48,42.374,48,40v-2c0-3.859-3.141-7-7-7s-7,3.141-7,7v2 c0,2.372,1.189,4.469,3,5.736v0.51l-3.374,0.963C31.491,47.82,30,49.797,30,52.018V55h22v-2.982 C52,49.797,50.509,47.82,48.373,47.209z M36,40v-2c0-2.757,2.243-5,5-5s5,2.243,5,5v2c0,2.757-2.243,5-5,5S36,42.757,36,40z M42.965,46.714L41,49.333l-1.965-2.619C39.659,46.897,40.318,47,41,47S42.341,46.897,42.965,46.714z M50,53H32v-0.982 c0-1.332,0.895-2.519,2.176-2.885l3.437-0.982L41,52.667l3.387-4.516l3.437,0.982C49.105,49.499,50,50.686,50,52.018V53z">
                                            </path>
                                            <rect height="2" width="2" x="27" y="13"></rect>
                                            <rect height="2" width="24" x="31" y="13"></rect>
                                            <rect height="2" width="22" x="33" y="17"></rect>
                                            <rect height="2" width="22" x="33" y="21"></rect>
                                            <rect height="2" width="2" x="53" y="25"></rect>
                                            <rect height="2" width="18" x="33" y="25"></rect>
                                        </g>
                                    </g>
                                </svg>
                                Solicitud de cuentas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logs.index') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg fill="#585858" width="24px" height="24px" viewBox="0 0 32.00 32.00"
                                    version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#000000"
                                    stroke-width="0.00032">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="0.32"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>logs</title>
                                        <path
                                            d="M0 24q0 0.832 0.576 1.44t1.44 0.576h1.984q0 2.496 1.76 4.224t4.256 1.76h6.688q-2.144-1.504-3.456-4h-3.232q-0.832 0-1.44-0.576t-0.576-1.408v-20q0-0.832 0.576-1.408t1.44-0.608h16q0.8 0 1.408 0.608t0.576 1.408v7.232q2.496 1.312 4 3.456v-10.688q0-2.496-1.76-4.256t-4.224-1.76h-16q-2.496 0-4.256 1.76t-1.76 4.256h-1.984q-0.832 0-1.44 0.576t-0.576 1.408 0.576 1.44 1.44 0.576h1.984v4h-1.984q-0.832 0-1.44 0.576t-0.576 1.408 0.576 1.44 1.44 0.576h1.984v4h-1.984q-0.832 0-1.44 0.576t-0.576 1.408zM10.016 24h2.080q0-0.064-0.032-0.416t-0.064-0.576 0.064-0.544 0.032-0.448h-2.080v1.984zM10.016 20h2.464q0.288-1.088 0.768-1.984h-3.232v1.984zM10.016 16h4.576q0.992-1.216 2.112-1.984h-6.688v1.984zM10.016 12h16v-1.984h-16v1.984zM10.016 8h16v-1.984h-16v1.984zM14.016 23.008q0 1.824 0.704 3.488t1.92 2.88 2.88 1.92 3.488 0.704 3.488-0.704 2.88-1.92 1.92-2.88 0.704-3.488-0.704-3.488-1.92-2.88-2.88-1.92-3.488-0.704-3.488 0.704-2.88 1.92-1.92 2.88-0.704 3.488zM18.016 23.008q0-2.080 1.44-3.52t3.552-1.472 3.52 1.472 1.472 3.52q0 2.080-1.472 3.52t-3.52 1.472-3.552-1.472-1.44-3.52zM22.016 23.008q0 0.416 0.288 0.704t0.704 0.288h1.984q0.416 0 0.704-0.288t0.32-0.704-0.32-0.704-0.704-0.288h-0.992v-0.992q0-0.416-0.288-0.704t-0.704-0.32-0.704 0.32-0.288 0.704v1.984z">
                                        </path>
                                    </g>
                                </svg>
                                Logs de usuarios
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                <svg width="26px" height="26px" viewBox="0 0 16 16"
                                    xmlns="http://www.w3.org/2000/svg" fill="#4c4c4c" stroke="#4c4c4c"
                                    stroke-width="0.00016">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.48 4h4l.5.5v2.03h.52l.5.5V8l-.5.5h-.52v3l-.5.5H9.36l-2.5 2.76L6 14.4V12H3.5l-.5-.64V8.5h-.5L2 8v-.97l.5-.5H3V4.36L3.53 4h4V2.86A1 1 0 0 1 7 2a1 1 0 0 1 2 0 1 1 0 0 1-.52.83V4zM12 8V5H4v5.86l2.5.14H7v2.19l1.8-2.04.35-.15H12V8zm-2.12.51a2.71 2.71 0 0 1-1.37.74v-.01a2.71 2.71 0 0 1-2.42-.74l-.7.71c.34.34.745.608 1.19.79.45.188.932.286 1.42.29a3.7 3.7 0 0 0 2.58-1.07l-.7-.71zM6.49 6.5h-1v1h1v-1zm3 0h1v1h-1v-1z">
                                        </path>
                                    </g>
                                </svg>
                                Chatbot de asistencia
                            </a>
                        </li>

                        <!-- Menu Reportes -->
                        <ul class="text-xs font-bold text-slate-400 tracking-wider mb-2">
                            <li>
                                <details>
                                    <summary>REPORTES</summary>
                                    <ul>
                                        <li>
                                            <a href="{{ route('reports.audit') }}"
                                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                                <svg fill="#4c4c4c" width="30px" height="30px"
                                                    viewBox="0 0 32 32" id="icon"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs>
                                                            <style>
                                                                .cls-1 {
                                                                    fill: none;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <title>report--alt</title>
                                                        <rect x="10" y="18" width="8" height="2"></rect>
                                                        <rect x="10" y="13" width="12" height="2"></rect>
                                                        <rect x="10" y="23" width="5" height="2"></rect>
                                                        <path
                                                            d="M25,5H22V4a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2V5H7A2,2,0,0,0,5,7V28a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V7A2,2,0,0,0,25,5ZM12,4h8V8H12ZM25,28H7V7h3v3H22V7h3Z">
                                                        </path>
                                                        <rect id="_Transparent_Rectangle_"
                                                            data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                                                            width="32" height="32"></rect>
                                                    </g>
                                                </svg>
                                                Comportamiento de los usuarios
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                                <svg fill="#4c4c4c" width="24px" height="24px"
                                                    viewBox="0 0 32 32" id="icon"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs>
                                                            <style>
                                                                .cls-1 {
                                                                    fill: none;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <title>report--alt</title>
                                                        <rect x="10" y="18" width="8" height="2"></rect>
                                                        <rect x="10" y="13" width="12" height="2"></rect>
                                                        <rect x="10" y="23" width="5" height="2"></rect>
                                                        <path
                                                            d="M25,5H22V4a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2V5H7A2,2,0,0,0,5,7V28a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V7A2,2,0,0,0,25,5ZM12,4h8V8H12ZM25,28H7V7h3v3H22V7h3Z">
                                                        </path>
                                                        <rect id="_Transparent_Rectangle_"
                                                            data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                                                            width="32" height="32"></rect>
                                                    </g>
                                                </svg>
                                                Acceso a los servicios
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.trends') }}"
                                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                                <svg fill="#4c4c4c" width="26px" height="26px"
                                                    viewBox="0 0 32 32" id="icon"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs>
                                                            <style>
                                                                .cls-1 {
                                                                    fill: none;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <title>report--alt</title>
                                                        <rect x="10" y="18" width="8" height="2"></rect>
                                                        <rect x="10" y="13" width="12" height="2"></rect>
                                                        <rect x="10" y="23" width="5" height="2"></rect>
                                                        <path
                                                            d="M25,5H22V4a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2V5H7A2,2,0,0,0,5,7V28a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V7A2,2,0,0,0,25,5ZM12,4h8V8H12ZM25,28H7V7h3v3H22V7h3Z">
                                                        </path>
                                                        <rect id="_Transparent_Rectangle_"
                                                            data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                                                            width="32" height="32"></rect>
                                                    </g>
                                                </svg>
                                                Servicios más utilizados
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.domain_requests') }}"
                                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                                <svg fill="#4c4c4c" width="34px" height="34px"
                                                    viewBox="0 0 32 32" id="icon"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs>
                                                            <style>
                                                                .cls-1 {
                                                                    fill: none;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <title>report--alt</title>
                                                        <rect x="10" y="18" width="8" height="2"></rect>
                                                        <rect x="10" y="13" width="12" height="2"></rect>
                                                        <rect x="10" y="23" width="5" height="2"></rect>
                                                        <path
                                                            d="M25,5H22V4a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2V5H7A2,2,0,0,0,5,7V28a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V7A2,2,0,0,0,25,5ZM12,4h8V8H12ZM25,28H7V7h3v3H22V7h3Z">
                                                        </path>
                                                        <rect id="_Transparent_Rectangle_"
                                                            data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                                                            width="32" height="32"></rect>
                                                    </g>
                                                </svg>
                                                Solicitud de cuentas del dominio
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-200 transition-colors text-slate-600 font-medium">
                                                <svg fill="#4c4c4c" width="24px" height="24px"
                                                    viewBox="0 0 32 32" id="icon"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs>
                                                            <style>
                                                                .cls-1 {
                                                                    fill: none;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <title>report--alt</title>
                                                        <rect x="10" y="18" width="8" height="2"></rect>
                                                        <rect x="10" y="13" width="12" height="2"></rect>
                                                        <rect x="10" y="23" width="5" height="2"></rect>
                                                        <path
                                                            d="M25,5H22V4a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2V5H7A2,2,0,0,0,5,7V28a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V7A2,2,0,0,0,25,5ZM12,4h8V8H12ZM25,28H7V7h3v3H22V7h3Z">
                                                        </path>
                                                        <rect id="_Transparent_Rectangle_"
                                                            data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                                                            width="32" height="32"></rect>
                                                    </g>
                                                </svg>
                                                Gráficos
                                            </a>
                                        </li>
                                    </ul>
                                </details>
                            </li>
                        </ul>
                    </ul>
                </div>

                <!-- Perfil de Usuario Footer -->
                <div
                    class="flex items-center justify-between p-3 bg-base-100 rounded-xl border border-base-200 shadow-sm gap-2">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="avatar placeholder flex-shrink-0">
                            <div
                                class="bg-[#1e3a8a] text-white rounded-full w-10 h-10 flex items-center justify-center font-bold uppercase">
                                <span>{{ auth()->check() ? substr(auth()->user()->name, 0, 2) : 'NE' }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col min-w-0">
                            <span class="font-bold text-slate-800 text-sm truncate">
                                {{ auth()->check() ? auth()->user()->name : 'No tiene nombre' }}
                            </span>
                            <span class="text-xs text-slate-400 font-medium tracking-wide uppercase truncate">
                                {{ auth()->check() && auth()->user()->roles->isNotEmpty() ? auth()->user()->roles->first()->name : 'No tiene rol' }}
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('auth.logout') }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button type="submit"
                            class="text-[#f05252] hover:bg-red-50 p-2 rounded-lg transition-colors flex items-center justify-center"
                            title="Cerrar sesión">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
        </aside>
    </div>
    <!-- Add Laravel Notify JavaScript -->
    @notifyJs
</body>

</html>
