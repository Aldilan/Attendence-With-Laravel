<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function auth(Request $request)
    {
        $input = $request->all();

        $credentials = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->is_admin == "admin") {
                return redirect()->intended('/asAdmin');
            }
            return redirect()->intended('/asStudent');
        }

        return back()->with('loginError','Login failed!');

    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
