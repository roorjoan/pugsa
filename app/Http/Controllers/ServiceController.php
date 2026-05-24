<?php

namespace App\Http\Controllers;

use App\Events\ServiceAccessed;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Muestra una lista de servicios.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $services = Service::latest()->paginate(10);

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

        // Crear el servicio con el array limpio y modificado
        Service::create($validated);

        notify()
            ->success()
            ->title('Servicio creado correctamente.')
            ->send();

        return to_route('services.index');
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
     * Actualiza el servicio y asigna una lista de usuarios al servicio
     *
     * @param  \App\Http\Requests\Service\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        // Procesar el archivo del icono solo si se subió uno nuevo
        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($service->icon);

            // Almacena la nueva imagen en storage/app/public/icons
            $validated['icon'] = $request->file('icon')->store('icons', 'public');
        } else {
            unset($validated['icon']);
        }

        $service->update($validated);

        // Sincronizar los usuarios con el servicio
        $userIds = $request->input('user_ids', []);
        $service->users()->sync($userIds);

        notify()
            ->success()
            ->title('Servicio actualizado correctamente.')
            ->send();

        return to_route('services.index');
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

        Storage::disk('public')->delete($service->icon);

        notify()
            ->success()
            ->title('Servicio eliminado correctamente.')
            ->send();

        return to_route('services.index');
    }

    /**
     * Ejecuta un servicio, registra el log de auditoría y redirige al usuario.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function execute(Service $service)
    {
        // Disparamos el evento para la auditoría (Logs)
        ServiceAccessed::dispatch($service);

        // Manejo de portal WEB
        if ($service->type === 'web') {
            return redirect()->away($service->path);
        }

        // Manejo de ESCRITORIO REMOTO (MSTSC)
        if ($service->type === 'remoto') {
            // Construimos el contenido de un archivo RDP nativo de Windows
            $rdpContent = "full address:s:{$service->path}\r\n";
            $rdpContent .= "prompt for credentials:i:1\r\n";
            $rdpContent .= "displayconnectionbar:i:1\r\n";
            
            // Nombre del archivo limpio (reemplaza espacios por guiones bajos)
            $filename = str_replace(' ', '_', $service->name) . '.rdp';

            // Forzamos la descarga. Al abrirlo, Windows lanzará mstsc automáticamente.
            return response($rdpContent, 200, [
                'Content-Type' => 'application/x-rdp',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        }

        return back();
    }
}
