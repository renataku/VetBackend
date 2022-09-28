<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use Illuminate\Http\Response;

class BreedController extends Controller
{
    public function list(): Response
    {
        $breeds = Breed::with('species')->get();
        $response = [];

        foreach ($breeds as $breed) {
            $element = [
                'id' => $breed->id,
                'name' => $breed->name,
                'species_id' => $breed->species->id,
                'species_name' => $breed->species->name,
            ];
            array_push($response, $element);
        };
        return response($response, 201);
    }
}
