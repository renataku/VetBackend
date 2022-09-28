<?php

use App\Http\Controllers\Admin\GenerateSlotsController;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Employee\AppointmentController as EmployeeAppointment;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\ClientController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Client\SlotsController;
use App\Http\Controllers\Employee\BreedController;
use App\Http\Controllers\Employee\SpeciesController;
use App\Http\Controllers\Employee\PetController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public routes
Route::post('/client/register', [ClientAuthController::class, 'register']);
Route::post('/client/login', [ClientAuthController::class, 'login']);
Route::post('/employee/login', [EmployeeController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin
    Route::post('/admin/slots', [GenerateSlotsController::class, 'slots']);
    Route::post('/employee/create', [AdminEmployeeController::class, 'create']);
    Route::get('/employees', [AdminEmployeeController::class, 'list']);
    Route::get('/employees/all', [AdminEmployeeController::class, 'listAll']);
    Route::get('/employee/show/{id}', [AdminEmployeeController::class, 'show']);
    Route::put('/employee/update/{id}', [AdminEmployeeController::class, 'update']);
    Route::delete('/employee/delete/{id}', [AdminEmployeeController::class, 'destroy']);
    Route::get('roles', [RoleController::class, 'list']);

    //employee
    Route::post('/employee/logout', [EmployeeController::class, 'logout']);
    Route::get('employee/todayclients/{id}', [EmployeeAppointment::class, 'list']);
    Route::get('employee/allclients/{id}', [EmployeeAppointment::class, 'allList']);
    Route::get('employee/showappointment/{id}', [EmployeeAppointment::class, 'show']);
    Route::post('employee/updateappointment/{id}', [EmployeeAppointment::class, 'update']);
    Route::get('employee/showhistoryappointment/{id}', [EmployeeAppointment::class, 'showHistory']);

    //pets
    Route::get('breeds', [BreedController::class, 'list']);
    Route::get('species', [SpeciesController::class, 'list']);
    Route::post('pet/{id}', [PetController::class, 'create']);
    Route::get('pet/{id}', [PetController::class, 'show']);
    Route::put('pet/{id}', [PetController::class, 'update']);
    Route::delete('pet/{id}', [PetController::class, 'destroy']);

    //client
    Route::get('/client/{id}', [ClientController::class, 'show']);
    Route::get('/clients/list', [ClientController::class, 'list']);
    Route::post('/client/logout', [ClientAuthController::class, 'logout']);
    Route::get('/slots-for-registrations', [SlotsController::class, 'list']);
    Route::post('client/registertovet', [AppointmentController::class, 'create']);
    Route::get('client/registrations/{id}', [AppointmentController::class, 'list']);
    Route::delete('client/cancel-registrations/{id}', [AppointmentController::class, 'cancel']);
});
