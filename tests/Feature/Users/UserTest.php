<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;

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

test('muestra la lista de usuarios', function () {
    User::factory()->create(['name' => 'New User']);

    $response = $this->get(route('users.index'));

    $response->assertStatus(200);

    //verifica que haya al menos 1 registro en la db
    $this->assertDatabaseCount('users', 1);

    $response->assertSee('New User');
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

test('permite actualizar un usuario exitosamente', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create([ //producto original
        'name' => 'User 1',
        'email' => 'user1@pugsa.com',
    ]);
    //dd($user->name);

    // actualiza el usuario con el metodo put
    $response = $this->put(route('users.update', $user), [
        'name' => 'User 1 edited',
        'email' => 'user1edited@pugsa.com',
    ]);

    $response->assertRedirect(route('users.index')); //verifica la redireccion a la ruta

    $userUpdated = User::find($user->id); //recupera el ultimo registro guardado
    //dd($userUpdated->name);

    expect($userUpdated->name)->toBe('User 1 edited');
    expect($userUpdated->email)->toBe('user1edited@pugsa.com');

    /* // verifica que el usuario se actualice
    $this->assertDatabaseHas('users', [
        'name' => $userUpdated->name,
        'email' => $userUpdated->email,
    ]); */
});

test('se puede eliminar un usuario', function () {
    $user = User::factory()->create();

    $response = $this->delete(route('users.destroy', $user));

    $response->assertRedirect(route('users.index'));

    // Verificamos que no esta el usuario que fue eliminado
    $this->assertDatabaseMissing('users', ['id' => $user]);
});
