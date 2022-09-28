<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Slot;
use Illuminate\Http\Response;

class AdminEmployeeController extends Controller
{
    public function create(Request $request): Response
    {
        if (auth()->user()->role->title !== 'admin') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'position' => 'required|string',
            'role_id' => 'required|integer',
            'password' => 'required|string|confirmed',
        ]);

        $clientEmail = Employee::where('email', '=', $fields['email'])->get();
        if (count($clientEmail) > 0) {
            return response([
                'err_message' => 'Employee with this email is registered before'
            ], 400);
        }

        $client = Employee::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'position' => $fields['position'],
            'role_id' => $fields['role_id'],
            'password' => bcrypt($fields['password']),
        ]);

        return response([
            'message' => 'New employee created succesfully'
        ], 201);
    }

    public function list(Request $request): Response
    {
        if (auth()->user()->role->title !== 'admin') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $role = Role::where('title', 'vet')->first();
        $employees = Employee::where('role_id', $role->id)->select('id', 'first_name', 'last_name', 'email')->get();

        return response($employees, 201);
    }

    public function listAll(Request $request): Response
    {
        if (auth()->user()->role->title !== 'admin') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $employees = Employee::with('role')->get();
        $response = [];
        foreach ($employees as $employee) {
            $element = [
                'id' => $employee->id,
                'name' => $employee->first_name . " " . $employee->last_name,
                'email' => $employee->email,
                'position' => $employee->position,
                'role' => $employee->role->title,
            ];

            array_push($response, $element);
        };
        return response($response, 201);
    }

    public function destroy($id)
    {
        if (auth()->user()->role->title !== 'admin') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        if (auth()->user()->id == $id) {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $slots = Slot::where('employee_id', $id)
            ->get();

        if (count($slots) > 0) {
            return response([
                'message' => 'This employee can not be deleted'
            ], 405);
        }

        Employee::destroy($id);
        return response(['message' => 'The employee is deleted'], 201);
    }

    public function show(int $id): Response
    {
        if (auth()->user()->role->title !== 'admin') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }

        $employee = Employee::find($id, ['id', 'first_name', 'last_name', 'email', 'position', 'role_id']);

        return response($employee, 201);
    }

    public function update(Request $request, $id): Response
    {
        if (auth()->user()->role->title !== 'admin') {
            return response([
                'message' => 'You do not have permission for this action'
            ], 403);
        }
        $employee = Employee::find($id);
        $employee->update($request->all());

        return response([
            'message' => 'Employee data is updated'
        ], 201);
    }
}
