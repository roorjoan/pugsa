<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('users')->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:web,app',
            'icon' => 'nullable|string|max:255',
            'path' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Service::create($validated);

        return to_route('services.index');
    }

    public function show(Service $service)
    {
        $service->load('users');
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:web,app',
            'icon' => 'nullable|string|max:255',
            'path' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $service->update($validated);

        return to_route('services.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return to_route('services.index')->with('msg', 'Servicio eliminado correctamente.');
    }
}
