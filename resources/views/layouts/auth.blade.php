<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - UNE Granma</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 sm:p-8">

    <main
        class="w-full max-w-5xl bg-white rounded-[2rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col md:flex-row @yield('flex_direction')">

        <div class="relative w-full md:w-1/2 h-64 md:h-auto min-h-[300px] bg-slate-900">
            {{-- <img src="https://images.unsplash.com/photo-1541888060859-994df5a1e7de?q=80&w=2070&auto=format&fit=crop"
                alt="Lineman working" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-60"> --}}

            <div class="relative z-10 flex flex-col h-full p-8 md:p-12 justify-between">
                <div class="flex flex-col items-start drop-shadow-md">
                    <div class="text-[#f44336] flex items-center mb-1">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-extrabold text-white tracking-tight leading-none mb-1">UNE</h1>
                    <p class="text-white text-xs font-semibold tracking-widest uppercase">Empresa Eléctrica</p>
                    <p class="text-[#f44336] text-sm font-bold tracking-widest uppercase">Granma</p>
                </div>

                <div class="mt-12 bg-white/10 backdrop-blur-md border border-white/20 p-6 md:p-8 rounded-2xl shadow-xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight">@yield('welcome_title')</h2>
                    <p class="text-slate-200 text-sm md:text-base leading-relaxed">@yield('welcome_text')</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-14 flex flex-col justify-center bg-white">
            @yield('content')
        </div>

    </main>
</body>

</html>
