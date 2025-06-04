<?php

namespace App\Events;

use App\Models\Assignment; 
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AssignmentFinalized
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Assignment $assignment; 

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Assignment $assignment
     * @return void
     */
    public function __construct(Assignment $assignment) 
    {
        $this->assignment = $assignment; 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
