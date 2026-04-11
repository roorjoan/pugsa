<!DOCTYPE html>
<html lang="es" data-theme="night">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios — PUGSA</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        .font-display {
            font-family: 'Syne', sans-serif;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-row {
            animation: fadeInUp 0.3s ease both;
        }

        .animate-row:nth-child(1) {
            animation-delay: 0.04s;
        }

        .animate-row:nth-child(2) {
            animation-delay: 0.08s;
        }

        .animate-row:nth-child(3) {
            animation-delay: 0.12s;
        }

        .animate-row:nth-child(4) {
            animation-delay: 0.16s;
        }

        .animate-row:nth-child(5) {
            animation-delay: 0.20s;
        }

        .animate-row:nth-child(6) {
            animation-delay: 0.24s;
        }
    </style>
</head>

<body class="min-h-screen bg-base-300">

    {{-- ── NAVBAR ──────────────────────────────────────────────────────── --}}
    <div class="navbar bg-base-100 shadow-md px-6 sticky top-0 z-30">
        <div class="flex-1">
            <span class="font-display text-xl font-bold tracking-tight text-primary">PUGSA</span>
            <span class="mx-3 text-base-content/30">|</span>
            <span class="font-display text-base font-semibold text-base-content/70">Servicios</span>
        </div>
        <div class="flex-none gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm">Dashboard</a>
            <a href="{{ route('users.index') }}" class="btn btn-ghost btn-sm">Usuarios</a>
        </div>
    </div>

    {{-- ── CONTENIDO PRINCIPAL ─────────────────────────────────────────── --}}
    <main class="max-w-6xl mx-auto px-4 py-10">

        {{-- Encabezado + botón crear --}}
        <div class="flex items-end justify-between mb-8">
            <div>
                <h1 class="font-display text-4xl font-extrabold text-base-content tracking-tight">
                    Servicios
                </h1>
                <p class="text-base-content/50 mt-1 text-sm">
                    Gestiona los servicios disponibles en la plataforma.
                </p>
            </div>

            {{-- Abre el modal de CREAR --}}
            <button class="btn btn-primary gap-2" onclick="modal_create.showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo Servicio
            </button>
        </div>

        {{-- Flash message --}}
        @if (session('msg'))
            <div class="alert alert-success mb-6 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('msg') }}</span>
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-error mb-6 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ── TABLA DE SERVICIOS ──────────────────────────────────────── --}}
        @if($services?->isEmpty())
            <div class="hero min-h-48 bg-base-100 rounded-2xl">
                <div class="hero-content text-center">
                    <div>
                        <p class="font-display text-2xl font-bold text-base-content/40">Sin servicios registrados</p>
                        <p class="text-sm text-base-content/30 mt-1">Crea el primero con el botón de arriba.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="overflow-x-auto rounded-2xl shadow-xl bg-base-100">
                <table class="table table-zebra">
                    <thead>
                        <tr class="text-base-content/60 text-xs uppercase tracking-widest font-display">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Icono</th>
                            <th>Path</th>
                            <th>Usuarios</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr class="animate-row hover">
                                <td class="text-base-content/40 text-sm">{{ $service->id }}</td>

                                <td>
                                    <span class="font-display font-semibold text-base-content">
                                        {{ $service->name }}
                                    </span>
                                    <p class="text-xs text-base-content/40 mt-0.5 max-w-xs truncate">
                                        {{ $service->description }}
                                    </p>
                                </td>

                                <td>
                                    @if ($service->type === 'web')
                                        <div class="badge badge-info badge-outline text-xs font-semibold">🌐 Web</div>
                                    @else
                                        <div class="badge badge-accent badge-outline text-xs font-semibold">📱 App</div>
                                    @endif
                                </td>

                                <td class="text-base-content/50 text-sm">{{ $service->icon ?? '—' }}</td>

                                <td>
                                    <code class="text-xs bg-base-200 px-2 py-1 rounded-lg text-primary">
                                        {{ $service->path }}
                                    </code>
                                </td>

                                <td>
                                    <div class="badge badge-ghost">{{ $service->users->count() }}</div>
                                </td>

                                <td>
                                    <div class="flex gap-2 justify-end">

                                        {{-- Abre el modal de EDITAR de este servicio --}}
                                        <button class="btn btn-sm btn-ghost text-info"
                                            onclick="modal_edit_{{ $service->id }}.showModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Editar
                                        </button>

                                        {{-- Abre el modal de ELIMINAR de este servicio --}}
                                        <button class="btn btn-sm btn-ghost text-error"
                                            onclick="modal_delete_{{ $service->id }}.showModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Eliminar
                                        </button>

                                    </div>
                                </td>
                            </tr>


                            {{-- ════════════════════════════════════════════
                             MODAL EDITAR — uno por cada servicio
                        ════════════════════════════════════════════ --}}
                            <dialog id="modal_edit_{{ $service->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box w-11/12 max-w-2xl">

                                    <h3 class="font-display font-bold text-xl mb-6">Editar Servicio</h3>

                                    <form method="POST" action="{{ route('services.update', $service) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-control mb-4">
                                            <label class="label">
                                                <span class="label-text font-semibold">Nombre <span
                                                        class="text-error">*</span></span>
                                            </label>
                                            <input type="text" name="name" class="input input-bordered w-full"
                                                value="{{ $service->name }}" required />
                                        </div>

                                        <div class="form-control mb-4">
                                            <label class="label">
                                                <span class="label-text font-semibold">Tipo <span
                                                        class="text-error">*</span></span>
                                            </label>
                                            <select name="type" class="select select-bordered w-full" required>
                                                <option value="web"
                                                    {{ $service->type === 'web' ? 'selected' : '' }}>🌐 Web</option>
                                                <option value="app"
                                                    {{ $service->type === 'app' ? 'selected' : '' }}>📱 App</option>
                                            </select>
                                        </div>

                                        <div class="form-control mb-4">
                                            <label class="label">
                                                <span class="label-text font-semibold">
                                                    Icono
                                                    <span class="text-base-content/40 text-xs ml-1">(opcional)</span>
                                                </span>
                                            </label>
                                            <input type="text" name="icon" class="input input-bordered w-full"
                                                value="{{ $service->icon }}" />
                                        </div>

                                        <div class="form-control mb-4">
                                            <label class="label">
                                                <span class="label-text font-semibold">Path <span
                                                        class="text-error">*</span></span>
                                            </label>
                                            <input type="text" name="path" class="input input-bordered w-full"
                                                value="{{ $service->path }}" required />
                                        </div>

                                        <div class="form-control mb-6">
                                            <label class="label">
                                                <span class="label-text font-semibold">Descripción <span
                                                        class="text-error">*</span></span>
                                            </label>
                                            <textarea name="description" class="textarea textarea-bordered w-full h-24" required>{{ $service->description }}</textarea>
                                        </div>

                                        <div class="modal-action">
                                            {{-- form method="dialog" cierra el modal sin enviar el POST --}}
                                            <form method="dialog">
                                                <button class="btn btn-ghost">Cancelar</button>
                                            </form>
                                            <button type="submit" class="btn btn-info">
                                                Actualizar Servicio
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>cerrar</button>
                                </form>
                            </dialog>


                            {{-- ════════════════════════════════════════════
                             MODAL ELIMINAR — uno por cada servicio
                        ════════════════════════════════════════════ --}}
                            <dialog id="modal_delete_{{ $service->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box max-w-sm">

                                    <div class="flex flex-col items-center text-center gap-3 py-2">
                                        <div class="bg-error/10 p-4 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-error"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                        <h3 class="font-display font-bold text-xl">¿Eliminar servicio?</h3>
                                        <p class="text-base-content/60 text-sm">
                                            Estás a punto de eliminar
                                            <span
                                                class="font-semibold text-base-content">"{{ $service->name }}"</span>.
                                            Esta acción no se puede deshacer.
                                        </p>
                                    </div>

                                    <div class="modal-action justify-center gap-3 mt-4">
                                        {{-- form method="dialog" cierra el modal sin enviar el DELETE --}}
                                        <form method="dialog">
                                            <button class="btn btn-ghost btn-wide">Cancelar</button>
                                        </form>

                                        <form method="POST" action="{{ route('services.destroy', $service) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-wide">
                                                Sí, eliminar
                                            </button>
                                        </form>
                                    </div>

                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>cerrar</button>
                                </form>
                            </dialog>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>


    {{-- ════════════════════════════════════════════════════════════════════
     MODAL CREAR — único, fuera del foreach
════════════════════════════════════════════════════════════════════ --}}
    <dialog id="modal_create" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box w-11/12 max-w-2xl">

            <h3 class="font-display font-bold text-xl mb-6">Nuevo Servicio</h3>

            <form method="POST" action="{{ route('services.store') }}">
                @csrf

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text font-semibold">Nombre <span class="text-error">*</span></span>
                    </label>
                    <input type="text" name="name" placeholder="Ej. Portal Administrativo"
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        value="{{ old('name') }}" required />
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text font-semibold">Tipo <span class="text-error">*</span></span>
                    </label>
                    <select name="type" class="select select-bordered w-full @error('type') select-error @enderror"
                        required>
                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>Selecciona un tipo
                        </option>
                        <option value="web" {{ old('type') === 'web' ? 'selected' : '' }}>🌐 Web</option>
                        <option value="app" {{ old('type') === 'app' ? 'selected' : '' }}>📱 App</option>
                    </select>
                    @error('type')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text font-semibold">
                            Icono
                            <span class="text-base-content/40 text-xs ml-1">(opcional)</span>
                        </span>
                    </label>
                    <input type="text" name="icon" placeholder="Ej. globe, mobile, server"
                        class="input input-bordered w-full" value="{{ old('icon') }}" />
                </div>

                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text font-semibold">Path <span class="text-error">*</span></span>
                    </label>
                    <input type="text" name="path" placeholder="Ej. /portal-admin"
                        class="input input-bordered w-full @error('path') input-error @enderror"
                        value="{{ old('path') }}" required />
                    @error('path')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text font-semibold">Descripción <span class="text-error">*</span></span>
                    </label>
                    <textarea name="description" placeholder="Describe brevemente este servicio..."
                        class="textarea textarea-bordered w-full h-24 @error('description') textarea-error @enderror" required>{{ old('description') }}</textarea>
                    @error('description')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn btn-ghost">Cancelar</button>
                    </form>
                    <button type="submit" class="btn btn-primary">
                        Guardar Servicio
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>cerrar</button>
        </form>
    </dialog>

</body>

</html>
