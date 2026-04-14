<?php

namespace App\Http\Controllers\kepala_perpustakaan;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('kepala.dashboard', [
            'stats' => [
                'totalBooks' => Book::count(),
                'totalCategories' => Category::count(),
                'totalMembers' => User::where('role', User::ROLE_ANGGOTA)->count(),
                'totalStaff' => User::where('role', User::ROLE_PETUGAS)->count(),
                'totalLoans' => Peminjaman::count(),
            ],
        ]);
    }
}
