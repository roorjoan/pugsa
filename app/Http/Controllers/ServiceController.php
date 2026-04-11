<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    // Devuelve todos los servicios con sus usuarios paginados
    public function index()
    {
        $services = Service::with('users')->paginate(10);

        return view('services.index', compact('services'));
    }

    // Crea un nuevo servicio. Recibe un request con los datos del servicio
    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());

        return to_route('services.index')->with('msg', 'Servicio creado correctamente.');
    }

    // Actualiza un servicio. Recibe un request con los datos del servicio y el id del servicio
    public function update(UpdateServiceRequest $request, $id)
    {
        $service = Service::find($id);

        $service->update($request->validated());

        return to_route('services.index')->with('msg', 'Servicio actualizado correctamente.');
    }

    // Elimina un servicio. Recibe el id del servicio
    public function destroy($id)
    {
        $service = Service::find($id);

        $service->delete();

        return to_route('services.index')->with('msg', 'Servicio eliminado correctamente.');
    }
}