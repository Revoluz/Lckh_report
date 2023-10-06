<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403);
        }
        return view('user.Profile', [
            'user' => $user,
        ]);
    }
}
