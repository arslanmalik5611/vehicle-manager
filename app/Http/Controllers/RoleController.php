<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.list');
    }

    public function create()
    {
        return view('role.create');
    }

    public function edit()
    {
        return view('role.edit');
    }

    public function getRole(Request $request)
    {
        $roles = $request->role;
        $Roles = Role::when($roles, function ($role) use ($roles) {
            $role->whereIn('code', explode(',', $roles));
        })->get();

        return response()->json([
            'status' => true,
            'data' => $Roles
        ]);
    }
}
