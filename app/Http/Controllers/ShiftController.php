<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftStaff;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\CreateShiftRequest;

class ShiftController extends Controller
{
    // Create a shift schedule
    public function store(CreateShiftRequest $request)
    {
        $shift_name = $request->shift_name;
        // get the id of the shift_title from the shift table
        $shift_id = Shift::where('title', $shift_name)->pluck('id')->first();
        // create a new shift schedule
        $shift= ShiftStaff::create([
            'date' => $request->date,
            'email' => $request->input('email'),
            'shift_id' => $shift_id
        ]);

        return response()->json([$shift],201);


    }
}
