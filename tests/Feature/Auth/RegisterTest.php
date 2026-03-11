<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows a user to register successfully', function () {
    // 1. Arrange: Preparamos los datos del usuario 
    $userData = [
        'name' => 'admin',
        'email' => 'admin@pugsa.com',
        'password' => 'Admin123',
    ];

    // 2. Act: Simulamos la petición POST a la ruta de registro 
    $response = $this->post('/register', $userData);

    // 3. Assert: Verificamos el resultado esperado 
    // Comprobamos que redirige tras el éxito
    $response->assertRedirect('/login');

    // Verificamos que el usuario realmente se guardó en la base de datos
    $this->assertDatabaseHas('users', [
        'email' => 'admin@pugsa.com',
        'name' => 'admin',
    ]);
});
