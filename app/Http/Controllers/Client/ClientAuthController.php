<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    public function register(Request $request): Response
    {
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $clientEmail = Client::where('email', '=', $fields['email'])->get();
        if (count($clientEmail) > 0) {
            return response([
                'err_message' => 'User with this email is registered before'
            ], 400);
        }

        $client = Client::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'phone' => $fields['phone'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role_id' => 3
        ]);

        $token = $client->createToken('myapptoken')->plainTextToken;

        $response = [
            'id' => $client->id,
            'name' => $client->first_name . ' ' . $client->last_name,
            'role' => $client->role['title'],
            'token' => $token
        ];

        return response($response, 201);
    }

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
        $client = Client::where('email', $fields['email'])->first();

        //check password
        if (!$client || !Hash::check($fields['password'], $client->password)) {
            return response([
                'err_message' => 'incorrect email or password'
            ], 401);
        }

        $token = $client->createToken('myapptoken')->plainTextToken;

        $response = [
            'id' => $client->id,
            'name' => $client->first_name . ' ' . $client->last_name,
            'role' => $client->role['title'],
            'token' => $token
        ];

        return response($response, 201);
    }
}
