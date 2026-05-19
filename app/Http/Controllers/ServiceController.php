<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Models\User;

class ServiceController extends Controller
{
    /**
     * Muestra una lista de servicios.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $services = Service::paginate(10);

        return view('services.index', compact('services'));
    }

    /**
     * Muestra el formulario para crear un nuevo servicio.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view("services.create");
    }

    /**
     * Crea un nuevo servicio. Recibe un request con los datos del servicio
     *
     * @param  \App\Http\Requests\Service\StoreServiceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreServiceRequest $request)
    {
        // Obtener los datos previamente validados
        $validated = $request->validated();

        // Procesar y guardar el archivo si existe en la petición
        if ($request->hasFile('icon')) {
            // Almacena la imagen en storage/app/public/icons y devuelve la ruta relativa
            $validated['icon'] = $request->file('icon')->store('icons', 'public');
        }

        //dd($validated);

        // 3. Crear el servicio con el array limpio y modificado
        Service::create($validated);

        return to_route('services.index')->with('msg', 'Servicio creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un servicio y asignar el servicio a un usuario.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Service $service)
    {
        $users = User::all();
        return view("services.edit", compact("service", "users"));
    }

    /**
     * Actualiza el servicio y asigna el servicio a un usuario. Recibe un request con los datos del servicio.
     *
     * @param  \App\Http\Requests\Service\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        // Asignar el servicio al usuario
        $service->users()->sync($request->user_id);

        return to_route('services.index')->with('msg', 'Servicio actualizado correctamente.');
    }

    /**
     * Elimina un servicio. Recibe el id del servicio   
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return to_route('services.index')->with('msg', 'Servicio eliminado correctamente.');
    }
}
