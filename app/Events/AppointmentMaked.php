<?php

namespace App\Events;

use App\Models\Appointment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class AppointmentMaked
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /** @var Appointment */
    public $appointment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }
}
