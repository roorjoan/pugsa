<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ejecutamos nuestro nuevo seeder
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);

        // Crear un usuario de prueba y asignarle el rol
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin123'),
        ]);

        $admin->assignRole('administrator');

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('User123'),
        ]);

        $user->assignRole('user');

        //Service::factory(3)->create();
    }
}
