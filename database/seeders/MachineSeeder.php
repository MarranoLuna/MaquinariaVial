<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\MachineType;
use App\Models\MachineBrand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 

class MachineSeeder extends Seeder
{
    public function run(): void
    {

        for ($i = 0; $i < 5; $i++) {
            $randomType = MachineType::inRandomOrder()->first(); 
            $randomBrand = MachineBrand::inRandomOrder()->first(); 

            if ($randomType && $randomBrand) {
                Machine::firstOrCreate(
                    [
        
                        'serial_number' => strtoupper(substr($randomBrand->brand, 0, 3) . '-' . substr(str_replace(' ', '', $randomType->name), 0, 3))
                    ],
                    [
                        'id_type' => $randomType->id_type,
                        'id_brand' => $randomBrand->id_brand,
                        'kilometers' => rand(1000, 30000), 
                    ]
                );
            }
        }
    }
}
