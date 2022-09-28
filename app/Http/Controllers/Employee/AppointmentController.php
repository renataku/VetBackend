<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Appointment;
use App\Models\Slot;
use App\Models\Client;
use App\Models\Pet;

class AppointmentController extends Controller
{
    public function list(Request $request, int $employee_id): Response
    {
        if (auth()->user()->role->title == 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $today = date("Y-m-d");
        $slots = Slot::where('employee_id', $employee_id)
            ->whereBetween('date_from', [$today . " 00:00:00", $today . " 23:59:59"])
            ->where('status', slot::RESERVED)
            ->with('appointment')->get();

        if (count($slots) === 0) {
            return response(['message' => 'You do not have any clients today'], 201);
        }

        $response = [];

        foreach ($slots as $slot) {
            $element = [
                'appointment_id' => $slot->appointment->id,
                'slot_id' => $slot->id,
                'date_from' => $slot->date_from,
                'client_id' => $slot->appointment->client_id,
                'client_name' => $slot->appointment->client->first_name . ' ' .
                    $slot->appointment->client->last_name,
                'closed' => $slot->appointment->closed,
            ];
            array_push($response, $element);
        };

        return response($response, 201);
    }

    public function allList(Request $request, int $employee_id): Response
    {
        if (auth()->user()->role->title == 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $slots = Slot::where('employee_id', $employee_id)
            ->where('status', slot::RESERVED)
            ->with('appointment')->get();

        if (count($slots) === 0) {
            return response(['message' => 'You do not have any clients today'], 201);
        }

        $response = [];

        foreach ($slots as $slot) {
            $element = [
                'appointment_id' => $slot->appointment->id,
                'slot_id' => $slot->id,
                'date_from' => $slot->date_from,
                'client_id' => $slot->appointment->client_id,
                'client_name' => $slot->appointment->client->first_name . ' ' .
                    $slot->appointment->client->last_name,
                'closed' => $slot->appointment->closed,
            ];
            array_push($response, $element);
        };

        return response($response, 201);
    }


    public function show(int $appointment_id): Response
    {
        if (auth()->user()->role->title == 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $appointment = Appointment::with('slot')->find($appointment_id);
        $id = $appointment->client_id;
        $client = Client::find($id);
        $pets = Pet::with('breed', 'species')->where('client_id', $id)->get();

        $response = [
            'appointment' => $appointment,
            'client' => $client,
            'pets' => $pets
        ];

        return response($response, 201);
    }

    public function update(Request $request, int $appointment_id): Response
    {
        $request->validate([
            'pet_id' => 'required|integer',
            'description' => 'string',
            'closed' => 'required|boolean',
        ]);

        $appointment = Appointment::find($appointment_id);
        $appointment->update($request->all());
        $response = ['message' => "data updated"];
        return response($response, 201);
    }

    public function showHistory(int $appointment_id): Response
    {
        if (auth()->user()->role->title === 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $thisAppointment = Appointment::find($appointment_id);
        $id = $thisAppointment->pet_id;
        $appointments = Appointment::where('pet_id', $id)->with('slot')->get();
        $thisPet = Pet::find($id);
        $thisPetName = $thisPet->name;
        $response = [];

        foreach ($appointments as $appointment) {
            if ($appointment->id !== $appointment_id) {
                $element = [
                    'date_from' => $appointment->slot->date_from,
                    'employee' => $appointment->slot->employee->first_name . ' ' .
                        $appointment->slot->employee->last_name,
                    'description' => $appointment->description,
                ];

                array_push($response, $element);
            }
        }

        if (count($response) > 0) {
            $response[0] = array_merge($response[0], ['pet_name' => $thisPetName]);
        }
        return response($response, 201);
    }
}
