<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Role;

class RoleController extends Controller
{
    public function list(): Response
    {
        $roles = Role::where('suitable', 'employee')->get();
        $response = [];

        foreach ($roles as $role) {
            $element = [
                'id' => $role->id,
                'title' => $role->title,
            ];
            array_push($response, $element);
        };
        return response($response, 201);
    }
}
