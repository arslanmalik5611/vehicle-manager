<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function index()
    {
        return view('material.list');
    }
    public function all()
    {
        $Material = Material::with(['material_type', 'vendor'])->orderByDesc('id')->get();
        return response()->json([
            'status' => true,
            'data' => $Material
        ]);
    }

    public function create()
    {
        $Vendor = Vendor::all();
        $Material_type = MaterialType::all();

        return view('material.create', ['vendor' => $Vendor->toArray(), 'material_type' => $Material_type]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        if (isset($request->image)) {
            $picture = $request->file('image');
            $picture_name = '';
            if ($picture) {
                $type = $picture->getClientOriginalExtension();
                $picture_name = Str::random(10) . '.' . $type;
                $picture->move(public_path('uploads/vehicle-attachment'), $picture_name);
            }
        }


        $Material =  Material::create([
            'name' => $request->name,
            'number' => $request->number,
            'manufacturer' => $request->manufacturer,
            'vendor_id' => $request->vendor_id,
            'price' => $request->price,
            'material_type_id' => $request->material_type_id,
            'quantity' => $request->quantity,
            'image' => $picture_name??'',
            'notes' => $request->notes,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    public function edit()
    {
        
        $Vendor = Vendor::all();
        $Material_type = MaterialType::all();

        return view('material.edit', ['vendor' => $Vendor->toArray(), 'material_type' => $Material_type]);
    }

    public function show(Request $request)
    {
        $Material = Material::find($request->id);

        return response()->json([
            'status' => true,
            'data' => $Material
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        if (isset($request->image)) {
            $picture = $request->file('image');
            $picture_name = '';
            if ($picture) {
                $type = $picture->getClientOriginalExtension();
                $picture_name = Str::random(10) . '.' . $type;
                $picture->move(public_path('uploads/vehicle-attachment'), $picture_name);
            }
        }


        $Material =  Material::find($request->id);
        if($Material){

            $Material->name = $request->name;
            $Material->number = $request->number;
            $Material->manufacturer = $request->manufacturer;
            $Material->vendor_id = $request->vendor_id;
            $Material->price = $request->price;
            $Material->material_type_id = $request->material_type_id;
            $Material->quantity = $request->quantity;
            $Material->image = $picture_name??'';
            $Material->save();
            // 'notes' => $request->notes??,
        }

        return response()->json([
            'status' => true,
            'message' => 'Record updated successfully'
        ]);
    }

    public function delete(Request $request)
    {
        Material::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
