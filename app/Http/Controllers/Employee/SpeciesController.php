<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Species;

class SpeciesController extends Controller
{
    public function list(): Response
    {
        $species = Species::select('id', 'name')->get();


        return response($species, 201);
    }
}
