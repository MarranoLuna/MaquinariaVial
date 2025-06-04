<?php

namespace Database\Seeders;

use App\Models\MachineBrand;
use Illuminate\Database\Seeder;

class MachineBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       MachineBrand::firstOrcreate(['brand' => 'Michigan']);
       MachineBrand::firstOrcreate(['brand' => 'Cat']);
       MachineBrand::firstOrcreate(['brand' => 'Liangong']);
       MachineBrand::firstOrcreate(['brand' => 'John Deere']);
       MachineBrand::firstOrcreate(['brand' => 'Cukurova']);
       MachineBrand::firstOrcreate(['brand' => 'Liebherr']);
       MachineBrand::firstOrcreate(['brand' => 'Dynapac']);
    }
}
