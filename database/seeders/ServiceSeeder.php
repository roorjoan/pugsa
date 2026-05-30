<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name'        => 'Okta',
                'type'        => 'web',
                'path'        => 'https://www.okta.com',
                'description' => 'Plataforma en la nube de gestión de identidad',
                'icon'        => '',
            ],
            [
                'name'        => 'Rippling',
                'type'        => 'web',
                'path'        => 'https://www.rippling.com',
                'description' => 'Plataforma unificada de gestión de personal',
                'icon'        => '',
            ],
            [
                'name'        => 'Jumpcloud',
                'type'        => 'web',
                'path'        => 'https://jumpcloud.com/',
                'description' => 'Plataforma unificada de directorio en la nube',
                'icon'        => '',
            ],
            [
                'name'        => 'Correo EEG',
                'type'        => 'web',
                'path'        => 'http://correo.elecgrm.une.cu/',
                'description' => 'Correo empresa electrica',
                'icon'        => '',
            ],
            [
                'name'        => 'Elastix',
                'type'        => 'web',
                'path'        => 'http://172.18.25.2',
                'description' => 'Sistema de atencion al cliente',
                'icon'        => '',
            ],
        ];

        foreach ($services ?? [] as $serviceData) {
            Service::updateOrCreate(
                ['name' => $serviceData['name']],
                [
                    'type'        => $serviceData['type'],
                    'path'        => $serviceData['path'],
                    'description' => $serviceData['description'],
                    'icon'        => $serviceData['icon'] ?? null,
                ]
            );
        }
    }
}
