<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
        return view('Material.list');
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


        $Material =  Material::create([
            'name' => $request->name,
            'number' => $request->number,
            'manufacturer' => $request->manufacturer,
            'vendor_id' => $request->vendor_id,
            'price' => $request->price,
            'material_type_id' => $request->material_type_id,
            'quantity' => $request->quantity,
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
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Material::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
