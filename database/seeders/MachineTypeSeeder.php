<?php
namespace Database\Seeders;

use App\Models\MachineType;
use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    public function run(): void
    {
        MachineType::firstOrCreate(['name' => 'Niveladora']);
        MachineType::firstOrCreate(['name' => 'Excavadora']);
        MachineType::firstOrCreate(['name' => 'Compactadora']);
        MachineType::firstOrCreate(['name' => 'Retroexcavadora']);
        MachineType::firstOrCreate(['name' => 'Zanjadora']);
        MachineType::firstOrCreate(['name' => 'Pavimentadora']);
        MachineType::firstOrCreate(['name' => 'Hormigonera']); 
        MachineType::firstOrCreate(['name' => 'MiniCargadora']); 
    }
}
