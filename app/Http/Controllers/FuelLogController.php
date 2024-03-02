<?php

namespace App\Http\Controllers;

use App\Models\FuelLog;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuelLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Vehicle = Vehicle::all();

        return view('fuel-log.list', ['Vehicle' => $Vehicle->toArray()]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Vehicle = Vehicle::all();

        return view('fuel-log.create', ['Vehicle' => $Vehicle->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required:integer',
            'fill_up_date' => 'required',
            'starting_odometer' => 'required',
            'ending_odometer' => 'required',
            'total_cost' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        


        $FuelLog =  FuelLog::create([
            'vehicle_id' => $request->vehicle_id,
            'fill_up_date' => $request->fill_up_date,
            'odometer_unit' => $request->odometer_unit,
            'starting_odometer' => $request->starting_odometer,
            'ending_odometer' => $request->ending_odometer,
            'odometer_changes' => $request->ending_odometer-$request->starting_odometer,
            'total_cost' => $request->total_cost,
            'us_gallons' => $request->us_gallons,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelLog  $fuelLog
     * @return \Illuminate\Http\Response
     */
    public function getFuelLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required:integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $FuelLog = FuelLog::where('vehicle_id',$request->vehicle_id)->get();

        return response()->json([
            'status' => true,
            'data' => $FuelLog??Null
        ]);
    }

    public function edit()
    {
        return view('fuel-log.edit');
    }

    public function show(Request $request)
    {
        $FuelLog = FuelLog::find($request->id); 

        return response()->json([
            'status' => true,
            'data' => $FuelLog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FuelLog  $fuelLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelLog $fuelLog)
    {
        $validator = Validator::make($request->all(), [
            'fill_up_date' => 'required',
            'starting_odometer' => 'required',
            'ending_odometer' => 'required',
            'total_cost' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        


        $FuelLog = FuelLog::find($request->id);
        if($FuelLog){
            $FuelLog->fill_up_date = $request->fill_up_date;
            $FuelLog->odometer_unit = $request->odometer_unit;
            $FuelLog->starting_odometer = $request->starting_odometer;
            $FuelLog->ending_odometer = $request->ending_odometer;
            $FuelLog->odometer_changes = $request->ending_odometer-$request->starting_odometer;
            $FuelLog->total_cost = $request->total_cost;
            $FuelLog->us_gallons = $request->us_gallons;
            $FuelLog->notes = $request->notes;
            $FuelLog->save();

        }

        return response()->json([
            'status' => true,
            'message' => 'Record update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelLog  $fuelLog
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        FuelLog::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
