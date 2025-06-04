<?php
namespace Database\Seeders;

use App\Models\MachineType;
use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    public function run(): void
    {
        MachineType::create(['name' => 'Niveladora']);
        MachineType::create(['name' => 'Excavadora']);
        MachineType::create(['name' => 'Compactadora']);
        MachineType::create(['name' => 'Retroexcavadora']);
        MachineType::create(['name' => 'Zanjadora']);
        MachineType::create(['name' => 'Pavimentadora']);
    }
}
