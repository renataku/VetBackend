<?php

namespace App\Http\Controllers\Client;

use App\Events\AppointmentMaked;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    public function create(Request $request): Response
    {
        $fields = $request->validate([
            'slot_id' => 'required|integer',
            'client_id' => 'required|integer',
        ]);



        if (auth()->user()->id != $fields['client_id'] && auth()->user()->role->title === 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        // if slot is free for registration
        $slot = Slot::find($fields['slot_id']);
        if ($slot->status == Slot::RESERVED) {
            return response([
                'message' => 'The slot is reserved by another person, try other slot'
            ]);
        }

        $slot->status = Slot::RESERVED;
        $slot->save();
        $appointment = new Appointment();
        $appointment->slot_id = $fields['slot_id'];
        $appointment->client_id = $fields['client_id'];
        $appointment->save();

        AppointmentMaked::dispatch($appointment);
        $response = ['message' => 'succesful registration'];
        return response($response, 201);
    }

    public function list($client_id): Response
    {
        if (auth()->user()->role->title !== 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        if (auth()->user()->id != $client_id) {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }
        $today = date("Y-m-d");
        $appointments = Appointment::where('client_id', $client_id)
            ->where('pet_id', null)
            ->with('slot')
            ->get();
        $response = [];
        foreach ($appointments as $appointment) {
            if ($appointment->slot->date_from > $today . " 00:00:00") {
                $element = [
                    'appointment_id' => $appointment->id,
                    'date_from' => $appointment->slot->date_from,
                    'slot_id' => $appointment->slot->id,
                    'employee_id' => $appointment->slot->employee_id,
                    'employee_name' => $appointment->slot->employee
                        ->first_name . ' ' . $appointment
                        ->slot->employee->last_name,
                ];
                array_push($response, $element);
            }
        }
        return response($response, 201);
    }

    public function cancel(Request $request, int $client_id): Response
    {
        if (auth()->user()->role->title !== 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        if (auth()->user()->id !== $client_id) {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $fields = $request->validate([
            'appointment_id' => 'required|integer',
            'slot_id' => 'required|integer',
        ]);
        Appointment::destroy($fields['appointment_id']);


        $slot = Slot::find($fields['slot_id']);
        if ($slot) {
            $slot->status = Slot::CANCELLED;
            $slot->save();
        }


        return response([
            'message' => 'Your registration is cancelled'
        ]);
    }
}
