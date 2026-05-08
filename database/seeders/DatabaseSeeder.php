<?php

namespace Database\Seeders;

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

        // Opcional: Crear un usuario de prueba y asignarle el rol
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin123'),
        ]);

        $admin->assignRole('administrator');
    }
}
