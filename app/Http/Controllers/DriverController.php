<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    public function index()
    {
        return view('driver.list');
    }
    public function all()
    {
        $driver = Driver::orderByDesc('id')->get();
        return response()->json([
            'status' => true,
            'data' => $driver
        ]);
    }

    public function create()
    {
        return view('driver.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:drivers,name'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }


        $driver =  Driver::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    public function edit($id)
    {
        $Driver = Driver::find($id);

        return view('driver.edit', compact('Driver'));
    }

    public function update(Request $request)
    {
        $Driver = Driver::find($request->id);
        if ($Driver) {
            $Driver->name = $request->name;
            $Driver->save();

            return response()->json([
                'status' => true,
                'message' => 'Record Updated Successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Record Not Found'
        ]);
    }

    public function delete(Request $request)
    {
        Driver::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
