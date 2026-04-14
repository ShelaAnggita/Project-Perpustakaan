<?php

namespace App\Http\Controllers\kepala_perpustakaan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetugasController extends Controller
{
    public function index(): View
    {
        return view('kepala.petugas', [
            'staff' => User::where('role', User::ROLE_PETUGAS)->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        User::create($request->validate([
            'nama_lengkap' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]) + [
            'role' => User::ROLE_PETUGAS,
        ]);

        return back()->with('success', 'Akun petugas berhasil dibuat.');
    }
}
