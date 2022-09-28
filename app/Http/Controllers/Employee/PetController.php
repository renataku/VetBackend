<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Appointment;
use App\Models\Pet;

class PetController extends Controller
{
    public function create(Request $request, int $appointment_id): Response
    {
        if (auth()->user()->role->title === 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $appointment = Appointment::find($appointment_id);
        $id = $appointment->client_id;
        $pet = $request->all();

        $pet = array_merge($pet, array('client_id' => $id));
        Pet::create($pet);
        $response = ['message' => "new pet created"];
        return response($response, 201);
    }

    public function show(int $id): Response
    {
        if (auth()->user()->role->title === 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $pet = Pet::with('species')->find($id);

        return response($pet, 201);
    }

    public function update(Request $request, $id): Response
    {
        if (auth()->user()->role->title === 'client') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }



        $pet = Pet::find($id);
        $pet->update($request->all());
        $response = ['message' => "new pet created"];
        return response($response, 201);
    }

    public function destroy($id): Response
    {

        Pet::destroy($id);
        return response([
            'message' => 'Pet deleted'
        ], 201);
    }
}
