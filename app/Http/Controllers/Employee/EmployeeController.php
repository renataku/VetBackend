<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function logout(Request $request): array
    {
        auth()->user()->tokens()->delete();

        return [
            "message" => "Loged out"
        ];
    }

    public function login(Request $request): Response
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //check email
        $employee = Employee::where('email', $fields['email'])->first();

        //check password
        if (!$employee || !Hash::check($fields['password'], $employee->password)) {
            return response([
                'err_message' => 'incorrect email or password'
            ], 401);
        }

        $token = $employee->createToken('myapptoken')->plainTextToken;

        $response = [
            'id' => $employee->id,
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'role' => $employee->role['title'],
            'token' => $token
        ];

        return response($response, 201);
    }
}
