<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('la página de registro se muestra correctamente', function () {
    $response = $this->get(route('auth.register'));

    // Verificamos que el servidor responde con un código 200 (OK)
    $response->assertStatus(200);
});

/*it('permite registrar un usuario', function () {
    // Arrange: Preparamos los datos del usuario 
    $userData = [
        'name' => 'admin',
        'email' => 'admin@pugsa.com',
        'password' => 'Admin123',
    ];

    // Act: Simulamos la petición POST a la ruta de registro 
    $response = $this->post('/register', $userData);

    // Assert: Verificamos el resultado esperado 
    // Comprobamos que redirige tras el éxito
    $response->assertRedirect('/login');

    // Verificamos que el usuario realmente se guardó en la base de datos
    $this->assertDatabaseHas('users', [
        'email' => 'admin@pugsa.com',
        'name' => 'admin',
    ]);
});*/
