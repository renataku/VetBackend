<?php

namespace App\Listeners;

use App\Events\AppointmentMaked;
use App\Mail\AppointmentInfo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AppointmentMakedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AppointmentMaked  $event
     * @return void
     */
    public function handle(AppointmentMaked $event)
    {
        $appointment = $event->appointment;
        Mail::to($appointment->client->email)->send(new AppointmentInfo($appointment));
    }
}
