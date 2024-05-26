<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\DataTables\UserRoleDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleAdminController extends Controller
{
    public function index(RoleDataTable $dataTable)
    {
        // $roles = Role::all();
        // return view('admin.Role', ['roles' => $roles]);
        return $dataTable->render('admin.Role');
    }
    public function show(Role $role,UserRoleDataTable $dataTable)
    {
        // $users = User::where('role_id', $role->id)->get();
        // return view('admin.RoleShow', ['users' => $users]);
        return $dataTable->with('role',$role->id)->render('admin.Role');

    }
}
