<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentInfo extends Mailable
{
    use Queueable;
    use SerializesModels;

    private Appointment $appointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@vet.com', 'VetApp')
            ->view('emails.appointment_info')
            ->text('emails.appointment_info_text')
            ->with([
                'appointment' => $this->appointment,
            ])
            ->subject($this->appointment->slot->date_from . ' appointment to vet clinic');
    }
}
