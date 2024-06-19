<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shift;
use App\Models\ShiftStaff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\CreateShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Http\Resources\GetShiftsResource;

class ShiftStaffController extends Controller
{
        //  Show all shifts
    public function index(Request $request)
    {
        // $shift_staff = DB::select('SELECT * FROM shift_staff ORDER BY created_at DESC LIMIT 21');
        // get the last 20 inputs in descending oorder and paginate
        $perPage = $request->input('perPage') ?? 5;
        $page = intval($request->query('page'));
        $page = (isset($page) && $page > 1) ? $page : 1;
        $offset = ($page > 1) ? ($perPage * ($page - 1)) : 0; 

        $twoWeeksAgo = Carbon::now()->subWeeks(2);
        try {
             // get shifts assigned within the last 2 weeks
            $shift_staff = ShiftStaff::where('date', '>=', $twoWeeksAgo)
                            ->orderBy('date', 'desc')
                            ->orderBy('created_at', 'desc')
                            ->get();
            $total_results= $shift_staff->count();
            // get total number of pages
            $pages = ($total_results % $perPage == 0) ? ($total_results / $perPage) : (round($total_results / $perPage, 0) + 1);

            $pagination = [
                'from' => ($offset + 1),
                'last_page' => $pages,
                'per_page' => $perPage,
                'to' => ($offset + $perPage),
                'total' => $total_results
            ];
            $shiftStaff = GetShiftsResource::collection($shift_staff);

            return sendResponse('SUCCESS', $shiftStaff, $pagination, Response::HTTP_OK);
        } catch (\Throwable $th) {
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
