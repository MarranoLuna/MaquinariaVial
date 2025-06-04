<?php
namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        Province::firstOrCreate(['name' => 'Entre Rios']);
        Province::firstOrCreate(['name' => 'Buenos Aires']);
        Province::firstOrCreate(['name' => 'Corrientes']);
        Province::firstOrCreate(['name' => 'Misiones']);
        Province::firstOrCreate(['name' => 'Chaco']);
        Province::firstOrCreate(['name' => 'Formosa']);
        Province::firstOrcreate(['name' => 'Salta']);
        Province::firstOrcreate(['name' => 'Jujuy']);
        Province::firstOrcreate(['name' => 'Cordoba']);
        Province::firstOrcreate(['name' => 'Tucuman']);
        Province::firstOrcreate(['name' => 'San Luis']);
        Province::firstOrcreate(['name' => 'Mendoza']);
        Province::firstOrcreate(['name' => 'Chubut']);
        Province::firstOrcreate(['name' => 'Rio Negro']);
        Province::firstOrcreate(['name' => 'Tierra del Fuego']);
        Province::firstOrcreate(['name' => 'Santa Cruz']);
        Province::firstOrcreate(['name' => 'La Pampa']);
        Province::firstOrcreate(['name' => 'Santa Fe']);
        Province::firstOrcreate(['name' => 'Neuquen']);
        Province::firstOrcreate(['name' => 'Catamarca']);
        Province::firstOrcreate(['name' => 'San Juan']);
        Province::firstOrcreate(['name' => 'La Rioja']);
        Province::firstOrcreate(['name' => 'Santiago del Estero']);
    }
}
