<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterWpuController extends Controller
{
    public function index()
    {
        return view('register_wpu.index', [
            'title' => 'Registration'
        ]);
    }
    public function store(Request $request)
    {
        // validasi data form registrasi user
        $validatedData =  $request->validate([
            'name' => 'required|max:255',
            'username' => 'required', 'min:3', 'max:255', 'unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // Cara encript passowrd
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // Cara encipt password dengan hash
        $validatedData['password'] = Hash::make($validatedData['password']);

        // validasi sukses tambahkan data ke database user
        User::create($validatedData);
        // kembali ke halaman login, tampilkan flash data
        return redirect('/login_wpu')->with('success_message', 'Registration successfull! Pleace login');
    }
}
