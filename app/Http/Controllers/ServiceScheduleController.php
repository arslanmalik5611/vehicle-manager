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

        return view('service-schedule.create', ['Vehicle' => $Vehicle->toArray(), 'ServiceItem' => $ServiceItem->toArray()]);
    }

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
        if ($request->is_repeat && $request->is_repeat == 'on') {
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
    public function all(ServiceSchedule $serviceSchedule)
    {
        $ServiceSchedule = ServiceSchedule::with(['vehicle', 'service_item'])->get();
        return response()->json([
            'status' => true,
            'data' => $ServiceSchedule
        ]);
    }

    public function edit($id)
    {
        $ServiceItem = ServiceItem::all();
        $Vehicle = Vehicle::all();

        return view('service-schedule.edit', ['Vehicle' => $Vehicle->toArray(), 'ServiceItem' => $ServiceItem->toArray()]);
    }

    public function show($id)
    {
        $ServiceSchedule = ServiceSchedule::find($id);
        return response()->json([
            'status' => true,
            'data' => $ServiceSchedule
        ]);
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required',
            'service_item_id' => 'required',
            'id' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $is_repeat = 0;
        if ($request->is_repeat && $request->is_repeat == 'on') {
            $is_repeat = 1;
        }
        $ServiceSchedule = ServiceSchedule::find($request->id);

        $ServiceSchedule->vehicle_id = $request->vehicle_id;
        $ServiceSchedule->service_item_id = $request->service_item_id;
        $ServiceSchedule->is_repeat = $is_repeat;
        $ServiceSchedule->repeat_times = $request->repeat_times;
        $ServiceSchedule->repeat_type = $request->repeat_type;
        $ServiceSchedule->repeat_odometer_units = $request->repeat_odometer_units;
        $ServiceSchedule->show_reminder = $request->show_reminder;
        $ServiceSchedule->reminder_type = $request->reminder_type;
        $ServiceSchedule->reminder_odometer_units = $request->reminder_odometer_units;
        $ServiceSchedule->next_due_date = $request->next_due_date;
        $ServiceSchedule->next_due_miles = $request->next_due_miles;
        $ServiceSchedule->notes = $request->notes;
        $ServiceSchedule->save();

        return response()->json([
            'status' => true,
            'message' => 'Record updated successfully'
        ]);
    }
    public function destroy(ServiceSchedule $serviceSchedule)
    {
    }
}
