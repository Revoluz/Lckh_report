<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.Login');
    }
    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'nip' => ['required', 'numeric'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo());
            // return redirect()->intended('dashboard');
        }
        return back()->with('loginError', 'Login failed!');
    }
    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user->role->role == 'Administrator') {
            return route(
                'lckh.index'
            );
        } elseif ($user->role->role == 'Pengawas' || $user->role->role == 'Kepala kantor') {
            return route('lckh.index');
            # code...
        } elseif ($user->role->role == 'User') {
            return route('lckh.index');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
