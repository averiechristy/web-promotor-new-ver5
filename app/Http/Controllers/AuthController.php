<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard.index');
            } else {
                return redirect()->route('user.home');
            }
        }


        $request->session()->flash('error', "Kode Sales (username) atau Password tidak sesuai, silakan coba lagi");
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    
}
