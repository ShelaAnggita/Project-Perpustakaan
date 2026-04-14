<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.members.index', [
            'members' => User::where('role', User::ROLE_ANGGOTA)->withCount('peminjaman')->latest()->get(),
            'panel' => $request->is('kepala-perpustakaan/*') ? 'kepala' : 'petugas',
        ]);
    }
}
