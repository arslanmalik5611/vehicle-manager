<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service-item.list');
    }


    public function all()
    {
        $ServiceItem = ServiceItem::all();
        return response()->json([
            'status' => true,
            'data' => $ServiceItem
        ]);
        return view('service-item.list');
    }

    public function create()
    {
        // $Vendor = Vendor::all();
        // $Material_type = MaterialType::all();

        return view('service-item.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:service_items,name'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $is_repeat = 0;
        if($request->is_repeat && $request->is_repeat=='on'){
            $is_repeat = 1;
        }
        $ServiceItem =  ServiceItem::create([
            'name' => $request->name,
            'material_type_id' => $request->material_type_id,
            'is_repeat' => $is_repeat,
            'repeat_times' => $request->repeat_times,
            'repeat_type' => $request->repeat_type,
            'repeat_odometer_units' => $request->repeat_odometer_units,
            'show_reminder_times' => $request->show_reminder,
            'reminder_type' => $request->reminder_type,
            'reminder_odometer_units' => $request->reminder_odometer_units,
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
     * @param  \App\Models\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceItem  $serviceItem
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        ServiceItem::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
