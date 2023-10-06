<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleAdminController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.Role', ['roles' => $roles]);
    }
    public function show(Role $role)
    {
        $users = User::where('role_id', $role->id)->get();
        return view('admin.RoleShow', ['users' => $users]);
    }
}
