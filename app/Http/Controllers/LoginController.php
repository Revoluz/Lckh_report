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
        if (!(Auth::attempt($credentials))) {
            return redirect()->back()->with('loginError', 'Login failed!');
        }if($user->status->status != 'Aktif'){
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->back()->with('loginError', 'Your account is inactive');
        }
        elseif (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo());
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
