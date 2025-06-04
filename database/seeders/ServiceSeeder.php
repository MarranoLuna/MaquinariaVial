<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Service::firstOrCreate([
            'service' => 'Cambio de Aceite',
            'kilometers' => 5000
       ]);
       Service::firstOrCreate([
            'service' => 'Cambio Filtros',
            'kilometers' => 10000
       ]);
       Service::firstOrCreate([
            'service' => 'Revision general',
            'kilometers' => 6000
       ]);
       Service::firstOrCreate([
            'service' => 'Inspección y Ajuste de Frenos',
            'kilometers' => 15000
        ]);
        Service::firstOrCreate([
            'service' => 'Cambio de Neumáticos',
            'kilometers' => 50000
        ]);
        Service::firstOrCreate([
            'service' => 'Alineacion y balanceo',
            'kilometers' => 30000
        ]);
    }
}
