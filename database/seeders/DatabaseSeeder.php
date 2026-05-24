<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Database\Seeder;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ejecutamos nuestro nuevo seeder
        $this->call([
            RoleAndPermissionSeeder::class,
            ServiceSeeder::class,
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
    }
}
