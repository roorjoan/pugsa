@extends('layouts.app')

@section('title', 'Gestión de Servicios')

@section('content')
    <div class="p-4">
        <div class="mb-6 border-b border-base-300 pb-4">
            <p class="text-sm text-base-content/60">Edita un servicio en la plataforma.</p>
        </div>

        <div class="card bg-base-100 shadow-sm max-w-2xl border border-base-200">
            <div class="card-body gap-5 p-8">
                <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-4"
                    enctype="multipart/form-data">
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
                            <span class="label-text font-medium">Icono del servicio <span
                                    class="text-base-content/50 font-normal">(Opcional)</span></span>
                        </label>

                        <div class="flex items-center gap-4">
                            @if ($service->icon)
                                <div
                                    class="w-12 h-12 rounded-lg bg-base-200 border border-base-300 flex items-center justify-center p-1 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $service->icon) }}" alt="Icono actual"
                                        class="w-full h-full object-contain rounded-md">
                                </div>
                            @endif

                            <input type="file" id="icon" name="icon"
                                class="file-input file-input-bordered w-full focus:file-input-primary transition-all @error('icon') file-input-error @enderror"
                                accept="image/*" />
                        </div>

                        @error('icon')
                            <label class="label pt-1"><span
                                    class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full flex flex-col mt-4">
                        <label class="label pb-1.5 justify-start" for="description">
                            <span class="label-text font-medium">
                                Descripción <span class="text-base-content/50 font-normal">(Opcional)</span>
                            </span>
                        </label>

                        <textarea id="description" name="description" placeholder="Escribe una breve descripción sobre el servicio..."
                            class="textarea textarea-bordered w-full h-24 focus:textarea-primary transition-all resize-none @error('description') textarea-error @enderror">{{ old('description', $service->description ?? '') }}</textarea>

                        @error('description')
                            <label class="label pt-1">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label pb-1.5">
                            <span class="label-text font-medium text-base-content/80">Usuarios con acceso al servicio</span>
                        </label>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-48 overflow-y-auto p-3 bg-base-50 rounded-xl border border-base-200">
                            @foreach ($users as $user)
                                <label
                                    class="label cursor-pointer justify-start gap-3 hover:bg-base-200/50 p-2 rounded-lg transition-colors">
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                        class="checkbox checkbox-primary checkbox-sm"
                                        {{ in_array($user->id, old('user_ids', $service->users->pluck('id')->toArray())) ? 'checked' : '' }} />
                                    <div class="flex flex-col">
                                        <span
                                            class="label-text font-medium text-slate-700 text-sm">{{ $user->name }}</span>
                                        <span class="text-xs text-slate-400">{{ $user->email }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('user_ids')
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
                            Actualizar servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
