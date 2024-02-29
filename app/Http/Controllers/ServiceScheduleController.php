<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use App\Models\ServiceSchedule;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceScheduleController extends Controller
{
    public function index()
    {
        return view('service-schedule.list');
    }

    public function create()
    {
        $ServiceItem = ServiceItem::all();
        $Vehicle = Vehicle::all();

        return view('service-schedule.create', ['Vehicle' => $Vehicle->toArray(),'ServiceItem'=>$ServiceItem->toArray()]);

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
            'vehicle_id' => 'required',
            'service_item_id' => 'required',

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
        $ServiceSchedule =  ServiceSchedule::create([
            'vehicle_id' => $request->vehicle_id,
            'service_item_id' => $request->service_item_id,
            'is_repeat' => $is_repeat,
            'repeat_times' => $request->repeat_times,
            'repeat_type' => $request->repeat_type,
            'repeat_odometer_units' => $request->repeat_odometer_units,
            'show_reminder' => $request->show_reminder,
            'reminder_type' => $request->reminder_type,
            'reminder_odometer_units' => $request->reminder_odometer_units,
            'next_due_date' => $request->next_due_date,
            'next_due_miles' => $request->next_due_miles,
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
     * @param  \App\Models\ServiceSchedule  $serviceSchedule
     * @return \Illuminate\Http\Response
     */
    public function all(ServiceSchedule $serviceSchedule)
    {
        $ServiceSchedule = ServiceSchedule::with(['vehicle','service_item'])->get();
        return response()->json([
            'status' => true,
            'data' => $ServiceSchedule
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceSchedule  $serviceSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceSchedule $serviceSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceSchedule  $serviceSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceSchedule $serviceSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceSchedule  $serviceSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceSchedule $serviceSchedule)
    {
        //
    }
}
