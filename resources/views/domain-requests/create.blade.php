@extends('layouts.app')

@section('title', 'Solicitar Cuenta de Dominio')

@section('content')
    <div class="p-4">
        <div class="mb-6 border-b border-base-300 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-base-content mb-1">Accesos de Dominio</h1>

            @role('administrator')
                <a href="{{ route('domain-requests.index') }}"
                    class="btn btn-outline btn-sm border-[#5b21b6] text-[#5b21b6] hover:bg-[#5b21b6] hover:text-white rounded-lg shadow-sm gap-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Gestionar Solicitudes
                </a>
            @endrole
        </div>

        <div class="card bg-base-100 shadow-sm max-w-2xl mx-auto border border-base-200 rounded-xl mt-8">
            <div class="card-body items-center text-center p-10 gap-6">

                <div
                    class="w-20 h-20 rounded-full bg-purple-50 flex items-center justify-center text-[#5b21b6] mb-2 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                        </path>
                    </svg>
                </div>

                <div class="max-w-md">
                    <h2 class="text-xl font-bold text-base-content mb-2">Solicitar credenciales de red</h2>
                    <p class="text-sm text-base-content/60 leading-relaxed">
                        Al enviar esta solicitud, el administrador del sistema evaluará tu perfil para aprovisionarte una
                        cuenta oficial de dominio.
                    </p>
                </div>

                <form action="{{ route('domain-requests.store') }}" method="POST" class="w-full max-w-sm mt-4">
                    @csrf

                    <button type="submit"
                        class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none w-full font-semibold rounded-lg shadow-sm transition-colors group">
                        Enviar solicitud al Administrador
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>

                <div class="text-xs text-base-content/40 mt-2">
                    Tu solicitud quedará en estado <span class="font-semibold uppercase tracking-wide">Pendiente</span>
                    hasta su aprobación.
                </div>
            </div>
        </div>
    </div>
@endsection
