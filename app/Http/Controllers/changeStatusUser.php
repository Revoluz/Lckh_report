<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class changeStatusUser extends Controller
{
    public function index()
    {
        // add datatable user
        return view('admin.UserChangeStatus',[
            'statuses' => Status::all(),
        ]);
    }
    public function update(Request $request){
        $validated = $request->validate([
            'nama'=>'required',
            'status'=>'required'
        ]);
        // dd($validated);
        foreach ($validated['nama'] as $name) {
            $user = User::where('id',$name)->first();
            $user->status_id = $validated['status'];
            // dd($user);
            $user->update();
        }
        return redirect()->back()->with('success', 'Status User berhasil diupdate!');
    }
}
