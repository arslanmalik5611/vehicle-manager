<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function login()
    {
        return view('register.login');
    }

    public function login_backend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->first()
            ]);
        }
        $User = User::with('role')->where('email', $request->email)->first();

        if (!$User) {
            return response()->json([
                'status' => false,
                'message' => 'No user registered with this email'
            ]);
        }

        if (Hash::check($request->password, $User->password)) {

            $token = $User->createToken('Admin')->plainTextToken;

            if ($User->role->code == 'admin') {
                return response()->json([
                    'status' => true,
                    'message' => 'Logged in',
                    'token' => ['token' => $token],
                    'user' => $User
                ])->header('Cache-Control', 'private')->header('Authorization', $token);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Password!'
            ]);
        }
    }

    public function register()
    {
        return view('register.register');
    }

    public function registerBackend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => $validator->errors()->first()
            ]);
        }
        $role_id = Role::firstWhere('key', $request->role_key)->id;

        $User = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_code' => $request->phone_code,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'role_id' => $role_id,
            'email_verified_at' => Carbon::now(),
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'shift_starts_at' => date('H:i:s', strtotime($request->shift_Starts_At)),
            'shift_ends_at' => date('H:i:s', strtotime($request->shift_Ends_At)),

            // 'shift_starts_at' => $request->shift_Starts_At,
            // 'shift_ends_at' => $request->shift_Ends_At
        ]);
        if ($User) {
            return response()->json([
                'status' => true,
                'message' => 'Register Successfully'
            ]);
        }
    }

    public function forgot()
    {
        return view('register.forgot');
    }

    public function reset()
    {
        return view('register.reset');
    }
}
