<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard', [
            'stats' => [
                'pendingBorrow' => Peminjaman::where('status', Peminjaman::STATUS_MENUNGGU_PERSETUJUAN)->count(),
                'pendingReturn' => Peminjaman::where('status', Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN)->count(),
                'totalBooks' => Book::count(),
                'totalMembers' => User::where('role', User::ROLE_ANGGOTA)->count(),
                'totalCategories' => Category::count(),
            ],
        ]);
    }
}
