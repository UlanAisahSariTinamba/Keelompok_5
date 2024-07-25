<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginWpuController extends Controller
{
    public function index()
    {
        return view('login_wpu.index', [
            'title' => 'Login'
        ]);
    }
    public function autenticate(Request $request)
    {
        // Otentikasi data login form user
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        // Jika user lolos otentikasi, benar email & password redirect ke Dashboard
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        // jika user tidak lolos otentikasi, redirect ke login dengan pesan login error
        return back()->with('loginError', 'Login failed');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login_wpu');
    }
}
