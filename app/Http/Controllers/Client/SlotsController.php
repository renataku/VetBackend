<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DateTime;

class SlotsController extends Controller
{
    public function list(Request $request): Response
    {
        $timezone  = +3;
        $now = date("Y-m-d H:i:s", time() + 3600 * ($timezone + date("I")));
        $slots = Slot::with('employee')
            ->where('date_from', '>=', $now)
            ->where('status', slot::CREATED)
            ->orWhere('status', slot::CANCELLED)
            ->where('date_from', '>=', $now)
            ->get();
        $response = [];
        foreach ($slots as $slot) {
            $element = [
                'id' => $slot->id,
                'date_from' => $slot->date_from,
                'employee_id' => $slot->employee_id,
                'employee_name' => $slot->employee->first_name . ' ' . $slot->employee->last_name,
                'now' => $now,

            ];
            array_push($response, $element);
        };
        return response($response, 201);
    }
}
