@extends('layouts.app')

@section('title', 'Gestión de usuarios')

@section('content')
    <div class="max-w-6xl mx-auto">

        <!-- Cabecera de la página -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-white transition-colors">
                Administra los usuarios del sistema</h2>

            <!-- Boton que abre el modal de creacion de usuario -->
            <a href="{{ route('users.create') }}"
                class="btn bg-[#f05252] hover:bg-[#d94444] text-white border-none rounded-lg px-6 shadow-md shadow-red-200 dark:shadow-none font-semibold gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Usuario
            </a>
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
                            <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm transition-colors duration-300">
                        @foreach ($users as $user)
                            <!-- Fila 1 -->
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-[#1e3a8a] text-white rounded-full w-10 h-10 font-bold">
                                                <!-- Generar dos letras aleatorias en mayusculas -->
                                                <span>{{ strtoupper(substr($user->name, 0, 1)) . strtoupper(substr($user->name, -1)) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 dark:text-slate-200 text-base">
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
                                {{-- Boton para eliminar --}}
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="btn btn-ghost btn-sm btn-square text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro que deseas eliminar este usuario?')"
                                                class="btn btn-ghost btn-sm btn-square text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación Footer -->
            <div class="px-6 py-4 border-t border-base-200 bg-base-100 rounded-b-xl">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
