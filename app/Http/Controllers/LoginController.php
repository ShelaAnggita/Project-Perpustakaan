<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect($this->dashboardRoute(Auth::user()));
        }

        return view('login.index');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended($this->dashboardRoute($request->user()));
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function dashboardRoute(User $user): string
    {
        return match ($user->role) {
            User::ROLE_PETUGAS => route('petugas.dashboard'),
            User::ROLE_KEPALA => route('kepala.dashboard'),
            default => route('anggota.dashboard'),
        };
    }
}
