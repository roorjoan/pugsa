@extends('layouts.app')

@section('title', 'Gestión de Servicios')

@section('content')
    <div class="p-6">
        <div class="mb-6 border-b border-base-300 pb-4">
            <p class="text-sm text-base-content/60">Edita un servicio en la plataforma PUGSA.</p>
        </div>

        <div class="card bg-base-100 shadow-sm max-w-2xl border border-base-200">
            <div class="card-body gap-5 p-8">
                <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="name">
                            <span class="label-text font-medium">Nombre del servicio</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="input input-bordered w-full focus:input-primary transition-all @error('name') input-error @enderror"
                            value="{{ old('name', $service->name) }}" />
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
                                <option value="web" {{ old('type', $service->type) == 'web' ? 'selected' : '' }}>Web
                                </option>
                                <option value="application"
                                    {{ old('type', $service->type) == 'application' ? 'selected' : '' }}>Aplicación</option>
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
                                class="input input-bordered w-full focus:input-primary transition-all @error('path') input-error @enderror"
                                value="{{ old('path', $service->path) }}" />
                            @error('path')
                                <label class="label pt-1"><span
                                        class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="icon">
                            <span class="label-text font-medium">Icono <span
                                    class="text-base-content/50 font-normal">(Opcional)</span></span>
                        </label>
                        <input type="text" id="icon" name="icon"
                            class="input input-bordered w-full focus:input-primary transition-all @error('icon') input-error @enderror"
                            value="{{ old('icon', $service->icon) }}" />
                        @error('icon')
                            <label class="label pt-1"><span
                                    class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label pb-1.5" for="description">
                            <span class="label-text font-medium">Descripción <span
                                    class="text-base-content/50 font-normal">(Opcional)</span></span>
                        </label>
                        <textarea id="description" name="description"
                            class="textarea textarea-bordered h-24 focus:textarea-primary transition-all @error('description') textarea-error @enderror">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <label class="label pt-1"><span
                                    class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8">
                        <a href="{{ route('services.index') }}"
                            class="text-base-content/70 hover:text-base-content font-medium text-sm px-4">
                            Atrás
                        </a>
                        <button type="submit"
                            class="btn bg-[#5b21b6] hover:bg-[#4c1d95] text-white border-none px-6 font-semibold shadow-sm rounded-lg">
                            Actualizar servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
