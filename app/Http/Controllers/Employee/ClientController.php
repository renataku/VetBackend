<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Client;
use App\Models\Pet;

class ClientController extends Controller
{
    public function list(Request $request)
    {
        $clients = Client::all();
        return $clients;
    }

    public function show($id): Response
    {
        $client = Client::where('id', $id)->get();
        $pets = Pet::with('breed')->where('client_id', $id)->get();

        $response = [
            'client' => $client,
            'pets' => $pets
        ];

        return response($response, 200);
    }
}
