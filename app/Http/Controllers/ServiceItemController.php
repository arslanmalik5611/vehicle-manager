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
        if ($request->is_repeat && $request->is_repeat == 'on') {
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

    public function show($id)
    {
        $ServiceItem = ServiceItem::find($id);
        return response()->json([
            'status' => true,
            'data' => $ServiceItem
        ]);
    }


    public function edit($id)
    {
        $ServiceItem = ServiceItem::find($id);
        return view('service-item.edit', compact('ServiceItem'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'

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
        $ServiceItem = ServiceItem::find($request->id);
            $ServiceItem->name = $request->name;
            $ServiceItem->material_type_id = $request->material_type_id;
            $ServiceItem->is_repeat = $is_repeat;
            $ServiceItem->repeat_times = $request->repeat_times;
            $ServiceItem->repeat_type = $request->repeat_type;
            $ServiceItem->repeat_odometer_units = $request->repeat_odometer_units;
            $ServiceItem->show_reminder_times = $request->show_reminder_times;
            $ServiceItem->reminder_type = $request->reminder_type;
            $ServiceItem->reminder_odometer_units = $request->reminder_odometer_units;
            $ServiceItem->notes = $request->notes;
            $ServiceItem->save();

        return response()->json([
            'status' => true,
            'message' => 'Record Updated successfully'
        ]);
    }
    public function delete(Request $request)
    {
        ServiceItem::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
