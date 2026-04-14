<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    public function register()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'anggota',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
