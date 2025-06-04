<?php

namespace Database\Factories;

use App\Models\Machine;
use App\Models\MachineBrand;
use App\Models\MachineType;
use App\Models\Province; 
use Illuminate\Database\Eloquent\Factories\Factory;

class MachineFactory extends Factory
{
    protected $model = Machine::class;

    public function definition()
    {
        return [
            'serial_number' => strtoupper($this->faker->unique()->bothify('???-####')), // Ej: ABC-1234
            'kilometers' => $this->faker->numberBetween(0, 500000),
            // Asigna IDs de entidades relacionadas que ya existan o que también crees con factories
            'id_type' => MachineType::factory(), // O MachineType::inRandomOrder()->first()->id_type si ya tienes tipos
            'id_brand' => MachineBrand::factory(), // O MachineBrand::inRandomOrder()->first()->id_brand si ya tienes marcas
            'id_province' => Province::factory(), // O Province::inRandomOrder()->first()->id_province si ya tienes provincias
            // created_at y updated_at se manejan automáticamente
        ];
    }
}
