<?php

namespace App\Http\Controllers;

use App\Helpers\SiteHelper;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleInsurance;
use App\Models\VehicleLicense;
use App\Models\VehicleMechanical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehicle.list');
    }

    public function all()
    {
        $Vehicle = Vehicle::with(['driver', 'vehicle_type'])->orderByDesc('id')->get();
        return response()->json([
            'status' => true,
            'data' => $Vehicle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Driver = Driver::all();
        return view('vehicle.create', ['Driver' => $Driver->toArray()]);

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
            'model_year' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }


        // upload image
        if (isset($request->image)) {
            $picture = $request->file('image');
            $picture_name = '';
            if ($picture) {
                $type = $picture->getClientOriginalExtension();
                $picture_name = Str::random(10) . '.' . $type;
                $picture->move(public_path('uploads/vehicle-attachment'), $picture_name);
            }
        }

        $Vehicle =  Vehicle::create([
            'model_year' => $request->model_year,
            'odo_meter' => $request->odo_meter,
            'make' => $request->make,
            'vin_no' => $request->vin_no,
            'model' => $request->model,
            'vehicle_no' => $request->vehicle_no,
            'color' => $request->color,
            'driver_id' => $request->driver,
            'vehicle_type_id' => $request->vehicle_type,
            'department_id' => $request->department,
            'image' => $picture_name
        ]);


        $VehicleLicense =  VehicleLicense::create([
            'plate_no' => $request->plate_no,
            'renewal' => $request->renewal,
            'vehicle_id' => $Vehicle->id
        ]);

        $VehicleMechanical =  VehicleMechanical::create([
            'engine' => $request->engine,
            'transmission' => $request->transmission,
            'tire_size' => $request->tire_size,
            'vehicle_id' => $Vehicle->id
        ]);

        $VehicleInsurance =  VehicleInsurance::create([
            'company' => $request->company,
            'account_no' => $request->account_no,
            'premium' => $request->premium,
            'due' => $request->due,
            'vehicle_id' => $Vehicle->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(vehicle $vehicle)
    {
        $Driver = Driver::all();
        
        return view('vehicle.edit',['Driver' => $Driver->toArray()]);
    }

    public function show(Request $request)
    {
        $Vehicle = Vehicle::with(
            [
                'driver',
                'vehicle_type',
                'vehicle_insurance',
                'vehicle_mechanical',
                'vehicle_license'
            ]
        )->orderByDesc('id')->where('id', $request->id)->first();

        return response()->json([
            'status' => true,
            'data' => $Vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }


        // upload image
        // if (isset($request->image)) {
        //     $picture = $request->file('image');
        //     $picture_name = '';
        //     if ($picture) {
        //         $type = $picture->getClientOriginalExtension();
        //         $picture_name = Str::random(10) . '.' . $type;
        //         $picture->move(public_path('uploads/vehicle-attachment'), $picture_name);
        //     }
        // }

        $Vehicle_found = Vehicle::find($request->id);
        if (!$Vehicle_found) {
            return response([
                'message' => ['Vehicle not found']
            ], 404);
        }
        

        $Vehicle_found->model_year = $request->model_year;
        $Vehicle_found->odo_meter = $request->odo_meter;
        $Vehicle_found->make = $request->make;
        $Vehicle_found->vin_no = $request->vin_no;
        $Vehicle_found->model = $request->model;
        $Vehicle_found->vehicle_no = $request->vehicle_no;
        $Vehicle_found->color = $request->color;
        $Vehicle_found->driver_id = $request->driver;
        $Vehicle_found->vehicle_type_id = $request->vehicle_type;
        $Vehicle_found->department_id = $request->department;
        if (isset($request->image)) {
            $picture = $request->file('image');
            $picture_name = '';
            if ($picture) {
                $type = $picture->getClientOriginalExtension();
                $picture_name = Str::random(10) . '.' . $type;
                $picture->move(public_path('uploads/vehicle-attachment'), $picture_name);
                $Vehicle_found->image = $picture_name;
            }
        }
        $Vehicle_found->save();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Record updated successfully'
        // ]);

        $VehicleLicense = VehicleLicense::find($request->vehicle_license_id);
        if ($VehicleLicense) {
            $VehicleLicense->plate_no = $request->plate_no;
            $VehicleLicense->renewal = $request->renewal;
            $VehicleLicense->save();
        }

        $VehicleMechanical = VehicleMechanical::find($request->vehicle_mechanical_id);
        if ($VehicleMechanical) {
            $VehicleMechanical->engine = $request->engine;
            $VehicleMechanical->transmission = $request->transmission;
            $VehicleMechanical->tire_size = $request->tire_size;
            $VehicleMechanical->save();
        }

        $VehicleInsurance = VehicleInsurance::find($request->vehicle_insurance_id);
        if ($VehicleInsurance) {
            $VehicleInsurance->company = $request->company;
            $VehicleInsurance->account_no = $request->account_no;
            $VehicleInsurance->premium = $request->premium;
            $VehicleInsurance->due = $request->due;
            $VehicleInsurance->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Vehicle::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
