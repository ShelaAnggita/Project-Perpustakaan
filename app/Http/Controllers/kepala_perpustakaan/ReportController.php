<?php

namespace App\Http\Controllers\kepala_perpustakaan;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Peminjaman::with(['user', 'book'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return view('kepala.laporan', [
            'rows' => $query->get(),
            'statusAktif' => $request->query('status'),
        ]);
    }
}
