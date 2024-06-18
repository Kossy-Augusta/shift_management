<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllShiftResource;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $all_shifts = Shift::all();
        return response()->json(['error' => false, 'data' => AllShiftResource::collection($all_shifts)]);
    }
}
