<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Slot;
use App\Models\Employee;
use DateTime;
use DateInterval;
use DatePeriod;

class GenerateSlotsController extends Controller
{
    public function slots(Request $request): Response
    {

        $fields = $request->validate([
            'min' => 'required|integer|between:15,30',
            'employee_id' => 'required',
            'date' => 'required|date_format:Y-m-d|after:yesterday',
            'shift' => 'required|integer|between:1,2',
        ]);

        if (!$fields) {
            return response([
                'message' => 'error'
            ], 401);
        }

        //check if employee exists
        $employee = Employee::where('id', $fields['employee_id'])->first();
        if ($employee->role_id !== 2) {
            return response([
                'message' => 'employee does not exists or is not vet'
            ], 401);
        }

        if ($fields['shift'] == 1) {
            $start = ' 7:00';
            $finish = ' 14:00';
        } else {
            $start = ' 14:00';
            $finish = ' 20:00';
        };

        $slot = new Slot();
        $slot->date_from = new \DateTime();

        $begin = new DateTime($fields['date'] . $start);
        $end = new DateTime($fields['date'] . $finish);

        $ifSlotExist = Slot::where('date_from', $begin)->where('employee_id', $fields['employee_id'])->first();
        if ($ifSlotExist) {
            return response([
                'message' => 'identical slot exists'
            ], 401);
        }
        $interval = DateInterval::createFromDateString($fields['min'] . 'minutes');
        $period = new DatePeriod($begin, $interval, $end);

        /** @var DateTime $date */
        foreach ($period as $date) {
            $slot = new Slot();
            $slot->date_from = $date;
            $slot->date_to = (clone $date)->modify('+' . $fields['min'] . 'minutes');
            $slot->status = Slot::CREATED;
            $slot->employee_id = $fields['employee_id'];
            $slot->save();
        }


        return  response([
            "message" => "Slots generated succesfully"
        ], 201);
    }
}
