<?php

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Configuración global para este archivo de pruebas.
 * RefreshDatabase: Reinicia la base de datos en cada test para que esté limpia.
 * WithoutMiddleware: Desactiva capas de seguridad como el CSRF para facilitar el testing de POSTs.
 */
uses(
    RefreshDatabase::class,
    WithoutMiddleware::class
);

test('la página de servicios se muestra correctamente', function () {
    $response = $this->get(route('services.index'));

    expect($response->status())->toBe(200);
});

test('muestra la lista de servicios', function () {
    Service::create([
        'name'        => 'Portal Web',
        'type'        => 'web',
        'icon'        => 'globe',
        'path'        => '/portal',
        'description' => 'Portal principal de la empresa.',
    ]);

    $response = $this->get(route('services.index'));

    expect($response->status())->toBe(200);

    $this->assertDatabaseCount('services', 1);
    $response->assertSee('Portal Web');
});



test('permite actualizar un servicio exitosamente', function () {
    $this->withoutExceptionHandling();

    $service = Service::create([
        'name'        => 'Servicio Original',
        'type'        => 'web',
        'path'        => '/original',
        'description' => 'Descripción original.',
    ]);

    $response = $this->put(route('services.update', $service), [
        'name'        => 'Servicio Actualizado',
        'type'        => 'app',
        'icon'        => 'edit-icon',
        'path'        => '/actualizado',
        'description' => 'Descripción actualizada.',
    ]);

    $response->assertRedirect(route('services.index'));

    $serviceUpdated = Service::find($service->id);

    expect($serviceUpdated->name)->toBe('Servicio Actualizado');
    expect($serviceUpdated->type)->toBe('app');
    expect($serviceUpdated->path)->toBe('/actualizado');
});

test('se puede eliminar un servicio', function () {
    $service = Service::create([
        'name'        => 'Servicio a Eliminar',
        'type'        => 'web',
        'path'        => '/eliminar',
        'description' => 'Este servicio será eliminado.',
    ]);

    $response = $this->delete(route('services.destroy', $service));

    $response->assertRedirect(route('services.index'));

    $this->assertDatabaseMissing('services', ['id' => $service->id]);
});
