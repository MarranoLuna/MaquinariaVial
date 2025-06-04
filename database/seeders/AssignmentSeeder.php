<?php

namespace App\Events;

use App\Models\Assignment; // Asumiendo que tu modelo de asignación se llama Assignment
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AssignmentFinalized
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Assignment $assignment; // Propiedad pública para acceder a la asignación

    /**
     * Create a new event instance.
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }
}
