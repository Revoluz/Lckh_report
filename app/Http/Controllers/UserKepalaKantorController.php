<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserKepalaKantorController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403);
        }
        return view('kepala-kantor.Profile', [
            'user' => $user,
        ]);
    }
    public function changePassword(Request $request, User $user)
    {
        $rule = [
            'password' => 'required|min:8'
        ];
        $validateData = $request->validate($rule);
        $user->password = Hash::make($validateData['password']);
        $user->save();
        if ($user->save()) {
            return redirect()->route('userKepalaKantor.profile')->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Password gagal diubah!');
        }
    }
}
