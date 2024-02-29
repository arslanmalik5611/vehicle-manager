<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    public function index()
    {
        return view('state.list');
    }

    public function all()
    {
        $CampusType = State::orderByDesc('id')->get();
        return response()->json([
            'status' => true,
            'data' => $CampusType
        ]);
    }

    public function create()
    {
        return view('state.create');
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
        $State = new State;
        $State->name = $request->name;
        $State->save();

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }

    public function edit()
    {
        return view('state.edit');
    }

    public function show(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => State::find($request->id)
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->first()
            ]);
        }
        $State = State::find($request->id);
        $State->name = $request->name;
        $State->save();

        return response()->json([
            'status' => true,
            'message' => 'Record updated successfully'
        ]);
    }

    public function delete(Request $request)
    {
        State::where(['id' => $request->id])->delete();
        return response()->json([
            'status' => true,
            'message' => 'Record Deleted Successfully'
        ]);
    }
}
