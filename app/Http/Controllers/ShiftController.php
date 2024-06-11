<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftStaff;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\CreateShiftRequest;
use Illuminate\Http\Response;

class ShiftController extends Controller
{
    // Create a shift schedule
    public function store(CreateShiftRequest $request)
    {
        $shifts = [];
        foreach($request->emails as $item){
            $shifts[] = ShiftStaff::create([
                'date' => $request->date,
                'email' => $item,
                'shift_id' => $request->shift_id
            ]);
            
        }

        return response()->json(["error" => false, "data" => $shifts],Response::HTTP_CREATED);
    }
}
