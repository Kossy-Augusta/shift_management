<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftStaff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\CreateShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Http\Resources\GetShiftsResource;

class ShiftController extends Controller
{
        //  Show all shifts
    public function index()
    {
        // $shift_staff = DB::select('SELECT * FROM shift_staff ORDER BY created_at DESC LIMIT 21');
        // get the last 20 inputs in descending oorder and paginate
        try {
            $shift_staff = ShiftStaff::orderBy('date', 'desc')
                         ->orderBy('created_at', 'desc')
                         ->take(20)
                         ->paginate(5);

            return response()->json(['error' => false, "data" => GetShiftsResource::collection($shift_staff)], Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => true, 'message' => $th->__toString()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    // Create a shift schedule
    public function store(CreateShiftRequest $request)
    {
        $shifts = [];
        try {
            foreach($request->emails as $item){
            $shifts[] = ShiftStaff::create([
                'date' => $request->date,
                'email' => $item,
                'shift_id' => $request->shift_id
            ]);
            
        }
        } catch (\Throwable $th) {
            return response()->json(['error' => true,'message' => $th->__toString()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        

        return response()->json(["error" => false, "data" => $shifts],Response::HTTP_CREATED);
    }

    public function update($id, UpdateShiftRequest $request)
    {
        
        $shift = ShiftStaff::find($id);
        if (!$shift){
            return response()->json(["error" => true, "message" => "No shift found"], Response::HTTP_NO_CONTENT);
        }
        try {
            $shift->update([
            'date' => $request->date,
            'shift_id' => $request->shift_id
        ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true,'message' => $th->__toString()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        

        return response()->json(['error' => false,'data' => $shift, "message" => "products updated sucessfully"], Response::HTTP_CREATED);
    }
}
