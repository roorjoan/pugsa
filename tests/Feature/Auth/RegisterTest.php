<?php

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

/**
 * Test de humo (Smoke Test) para verificar que la ruta de registro carga.
 */
test('la página de registro se muestra correctamente', function () {
    // Realiza una petición GET a la ruta nombrada 'auth.register'
    $response = $this->get(route('auth.register'));

    // Verifica que el servidor devuelva un código 200 (éxito)
    $response->assertStatus(200);
});

/**
 * Test funcional para verificar el flujo completo de creación de usuario.
 */
test('permite registrar un usuario', function () {
    // Desactiva el manejo de excepciones de Laravel para ver el error real en consola si algo falla
    $this->withoutExceptionHandling();

    // Definimos el set de datos que simulan lo que el usuario escribe en el formulario
    $userData = [
        'name' => 'Admin',
        'email' => 'admin@pugsa.com',
        'password' => 'Admin123',
        'password_confirmation' => 'Admin123', // Debe coincidir con 'password' para pasar la validación
    ];

    // Envía una petición POST a la ruta de registro con los datos del usuario
    $response = $this->post(route('auth.register'), $userData);

    // Verifica que, tras el registro exitoso, el sistema nos redirija a la página de login
    $response->assertRedirect(route('auth.login'));

    // Consulta la base de datos para asegurar que el registro realmente se guardó
    $this->assertDatabaseHas('users', [
        'email' => 'admin@pugsa.com',
    ]);
});
