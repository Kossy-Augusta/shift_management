<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftStaff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\CreateShiftRequest;

class ShiftController extends Controller
{
        //  Show all shifts
    public function index()
    {
        // $products = DB::select('SELECT * FROM shift_staff ORDER BY created_at DESC LIMIT 21');
        // get the last 20 inputs in descending oorder and paginate
        $products = ShiftStaff::latest()->take(20)->paginate(5);
         return response()->json(['error' => false, "data" => $products]);
    }
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
