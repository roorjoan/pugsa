@extends('layouts.app')

@section('title', 'Gestión de Servicios')

@section('content')
    <div class="p-4">
        <div class="mb-6 border-b border-base-300 pb-4">
            <p class="text-sm text-base-content/60">Registra un nuevo servicio en la plataforma.</p>
        </div>

        <div class="card bg-base-100 shadow-sm max-w-2xl border border-base-200">
            <div class="card-body gap-5 p-8">
                <form action="{{ route('services.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="name">
                            <span class="label-text font-medium">Nombre del servicio</span>
                        </label>
                        <input type="text" id="name" name="name" placeholder="Ej. Portal de Facturación"
                            class="input input-bordered w-full focus:input-primary transition-all @error('name') input-error @enderror"
                            value="{{ old('name') }}" />
                        @error('name')
                            <label class="label pt-1"><span
                                    class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control w-full">
                            <label class="label pb-1.5" for="type">
                                <span class="label-text font-medium">Tipo</span>
                            </label>
                            <select id="type" name="type"
                                class="select select-bordered w-full focus:select-primary @error('type') select-error @enderror">
                                <option value="web" {{ old('type') == 'web' ? 'selected' : '' }}>Web</option>
                                <option disabled value="remoto" {{ old('type') == 'remoto' ? 'selected' : '' }}>Escritorio Remoto
                                </option>
                            </select>
                            @error('type')
                                <label class="label pt-1"><span
                                        class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label pb-1.5" for="path">
                                <span class="label-text font-medium">Ruta (Path)</span>
                            </label>
                            <input type="text" id="path" name="path"
                                placeholder="Ej. /ejecutable.exe o https://..."
                                class="input input-bordered w-full focus:input-primary transition-all @error('path') input-error @enderror"
                                value="{{ old('path') }}" />
                            @error('path')
                                <label class="label pt-1"><span
                                        class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="icon">
                            <span class="label-text font-medium">Icono del servicio <span
                                    class="text-base-content/50 font-normal">(Opcional)</span></span>
                        </label>

                        <input type="file" id="icon" name="icon"
                            class="file-input file-input-bordered w-full focus:file-input-primary transition-all @error('icon') file-input-error @enderror"
                            accept="image/*" />

                        @error('icon')
                            <label class="label pt-1"><span
                                    class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label pb-1.5" for="description">
                            <span class="label-text font-medium text-base-content/80">
                                Descripción <span class="text-base-content/40 font-normal">(Opcional)</span>
                            </span>
                        </label>

                        <textarea id="description" name="description" rows="3"
                            placeholder="Escribe una breve descripción sobre el servicio..."
                            class="textarea textarea-bordered w-full focus:textarea-primary transition-all resize-none @error('description') textarea-error @enderror">{{ old('description', $service->description ?? '') }}</textarea>

                        @error('description')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8">
                        <a href="{{ route('services.index') }}"
                            class="text-base-content/70 hover:text-base-content font-medium text-sm px-4">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-6 font-semibold shadow-sm rounded-lg">
                            Crear servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
