<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Login');
    }
    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'nip' => ['required', 'numeric'],
            'password' => ['required'],
        ]);
        $user = User::where('nip', $request->nip)->first();
        if (!Auth::attempt($credentials)) {
            // if ($user = User::where('nip', $request->nip)->first()) {
            //     if ($user->status->status != 'Aktif') {
            //         return back()->with('loginError', 'Your account is inactive');
            //     }
            // }
            return back()->with('loginError', 'Login failed!');
        }elseif($user->status->status != 'Aktif'){
                    return back()->with('loginError', 'Your account is inactive');
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo());
            // return redirect()->intended('dashboard');
        }

    }
    protected function redirectTo()
    {
            return route(
                'lckh.index'
            );
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
