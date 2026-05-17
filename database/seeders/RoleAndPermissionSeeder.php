<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar el caché de permisos de Spatie (Muy importante antes de empezar)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Definir lista de permisos
        $permissions = [
            // Usuarios
            'listar usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            // Servicios
            'listar servicios',
            'crear servicios',
            'editar servicios',
            'eliminar servicios',
            // Roles
            'listar roles',
            'crear roles',
            'editar roles',
            'eliminar roles',
            // Permisos
            'listar permisos',
            'crear permisos',
            'editar permisos',
            'eliminar permisos',
        ];

        // 2. Crear los permisos en la base de datos
        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // 3. Crear los roles
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'administrator']);
        $espRole = Role::create(['name' => 'especialista']);
        $dirRole = Role::create(['name' => 'director']);

        // 4. Asignar TODOS los permisos creados al administrador
        // Spatie permite pasar un array de nombres de permisos directamente
        $adminRole->givePermissionTo(Permission::all());

        // 5. Asignar permisos específicos al rol User
        $userRole->givePermissionTo([
            'listar servicios',
        ]);

        // 6. Asignar permisos específicos al rol Especialista
        $espRole->givePermissionTo([
            'listar servicios',
        ]);

        // 7. Asignar permisos específicos al rol Director
        $dirRole->givePermissionTo([
            'listar servicios',
        ]);
    }
}
