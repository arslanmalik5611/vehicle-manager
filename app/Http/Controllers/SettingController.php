<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Setting = Setting::first();

        // return view('home.index',['Setting'=>$Setting]);

        return view('setting.create', ['Setting' => $Setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'home_title' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        if (isset($request->home_image)) {
            $picture = $request->file('home_image');
            $picture_name = '';
            if ($picture) {
                $type = $picture->getClientOriginalExtension();
                $picture_name = Str::random(10) . '.' . $type;
                $picture->move(public_path('uploads/vehicle-attachment/'), $picture_name);
            }
        }

        $Setting = Setting::find(1);
        $Setting->home_title = $request->home_title;
        $Setting->home_description = $request->home_description;
        $Setting->home_image = url("/public/uploads/vehicle-attachment") ."/". ($picture_name ?? '');
        $Setting->save();

        return response()->json([
            'status' => true,
            'message' => 'Record saved successfully'
        ]);
    }
}
