<?php

namespace Database\Seeders;

use App\Models\EndReason;
use Illuminate\Database\Seeder;

class EndReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EndReason::firstOrcreate(['reason' => 'Fase completada']);
        EndReason::firstOrcreate(['reason' => 'Falla mecánica']);
        EndReason::firstOrcreate(['reason' => 'Reasignacion']);
        EndReason::firstOrcreate(['reason' => 'Fin de obra']);
        EndReason::firstOrcreate(['reason' => 'Condiciones climaticas']);
        EndReason::firstOrcreate(['reason' => 'Retraso en la obra']);
        EndReason::firstOrcreate(['reason' => 'Otra razon']);
    }
}
