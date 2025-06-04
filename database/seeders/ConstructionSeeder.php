<?php

namespace Database\Seeders;

use App\Models\Construction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class ConstructionSeeder extends Seeder
{
    
    public function run(): void
    {
        $startDate = '24/05/2025';
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate)->toDateString();
        Construction::firstOrCreate(
            [
                'name' => "Proyecto Vial Gualeguaychú",
                'id_province' => 2,
                'start_date' => $formattedStartDate,
                'end_date' => null,
            ]
        );
    }
}
