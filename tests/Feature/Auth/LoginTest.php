<?php

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Configuración global para este archivo de pruebas.
 * WithoutMiddleware: Desactiva capas de seguridad como el CSRF para facilitar el testing de POSTs.
 */
uses(WithoutMiddleware::class);

/**
 * Test de humo (Smoke Test) para verificar que la ruta de login carga.
 */
test('la página de login se muestra correctamente', function () {
    // Realiza una petición GET a la ruta nombrada 'auth.login'
    $response = $this->get(route('auth.login'));

    // Verifica que el servidor devuelva un código 200 (éxito)
    $response->assertStatus(200);
});

test('autenticar un usuario correctamente', function () {
    // Desactiva el manejo de excepciones de Laravel para ver el error real en consola si algo falla
    $this->withoutExceptionHandling();

    // Creamos un usuario de prueba usando el Factory
    $user = User::factory()->create([
        'email' => 'admin@pugsa.com',
        'password' => bcrypt('Admin123'),
    ]);

    // Simulamos la petición POST con las credenciales correctas
    $response = $this->post('/', [
        'email' => 'admin@pugsa.com',
        'password' => 'Admin123',
    ]);

    // Verificamos que el usuario haya iniciado sesión correctamente
    $this->assertAuthenticatedAs($user);
    $response->assertRedirect(route('dashboard'));
});

test('un usuario autenticado puede cerrar sesión', function () {
    // Desactiva el manejo de excepciones de Laravel para ver el error real en consola si algo falla
    $this->withoutExceptionHandling();

    // Creamos un usuario y lo autenticamos en la aplicación
    $user = User::factory()->create();

    // El helper actingAs() simula que este usuario ya inició sesión
    $this->actingAs($user);

    // (Opcional) Verificamos que efectivamente está logueado antes de continuar
    $this->assertAuthenticatedAs($user);

    // Simulamos la petición POST a la ruta de logout
    $response = $this->post(route('auth.logout'));

    // Confirmamos que el usuario ya no está autenticado
    $this->assertGuest();

    // Confirmamos que redirige a la página login
    $response->assertRedirect(route('auth.login'));
});
