<?php

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

test('la página de usuario se muestra correctamente', function () {
    // Realiza una petición GET a la ruta nombrada 'users.index'
    $response = $this->get(route('users.index'));

    // Verifica que el servidor devuelva un código 200 (éxito)
    $response->assertStatus(200);
});

test('permite crear un usuario', function () {
    $this->withoutExceptionHandling();

    // Creamos el usuario
    $newUserData = [
        'name' => 'New User',
        'email' => 'user@pugsa.com',
        'password' => 'User1234',
    ];

    $response = $this->post(route('users.store'), $newUserData);

    $response->assertRedirect(route('users.index'));

    // Verificamos que el usuario esté en la base de datos
    $this->assertDatabaseHas('users', [
        'email' => 'user@pugsa.com',
    ]);
});

test('se puede eliminar un usuario', function () {
    $user = User::factory()->create();

    $response = $this->delete(route('users.destroy', $user));

    $response->assertRedirect(route('users.index'));

    // Verificamos que no esta el usuario que fue eliminado
    $this->assertDatabaseMissing('users', ['id' => $user]);
});
