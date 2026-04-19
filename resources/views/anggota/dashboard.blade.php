@extends('layouts.app')

@section('title', 'Dashboard Anggota')
@section('page_title', 'Dashboard Anggota')
@section('page_description', 'Pantau buku yang sedang dipinjam, menunggu konfirmasi, dan total denda Anda.')

@section('content')
<div class="card-grid">
    <div class="card">
        <div class="muted">Sedang Dipinjam</div>
        <h2>{{ $totalDipinjam }}</h2>
    </div>
    <div class="card">
        <div class="muted">Menunggu Konfirmasi</div>
        <h2>{{ $totalMenunggu }}</h2>
    </div>
    <div class="card">
        <div class="muted">Menunggu Pengembalian</div>
        <h2>{{ $totalMenungguPengembalian }}</h2>
    </div>
    <div class="card">
        <div class="muted">Total Denda Saat Ini</div>
        <h2>Rp {{ number_format($totalDenda, 0, ',', '.') }}</h2>
    </div>
</div>

<div class="panel" style="margin-bottom:20px;">
    <h3>Pinjaman Aktif</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Batas Kembali</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjamanAktif as $item)
                    <tr>
                        <td>{{ $item->book->judul ?? $item->judul ?? '-' }}</td>
                        <td>
                            @if($item->status === 'dipinjam')
                                <span class="badge success">Sedang Dipinjam</span>
                            @elseif($item->status === 'menunggu_persetujuan')
                                <span class="badge info">Menunggu ACC</span>
                            @elseif($item->status === 'menunggu_acc')
                                <span class="badge warn">Pengembalian Ditunggu</span>
                            @elseif($item->status === 'disetujui')
                                <span class="badge info">Dalam Verifikasi</span>
                            @else
                                <span class="badge">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                            @endif
                        </td>
                        <td>{{ $item->batas_kembali?->format('d M Y H:i') ?? '-' }}</td>
                        <td>
                            @if(in_array($item->status, [\App\Models\Peminjaman::STATUS_MENUNGGU_ACC, \App\Models\Peminjaman::STATUS_DISETUJUI, \App\Models\Peminjaman::STATUS_SELESAI, \App\Models\Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN, \App\Models\Peminjaman::STATUS_DIKEMBALIKAN]))
                                Rp {{ number_format($item->denda_terhitung, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">Belum ada pinjaman aktif.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="panel">
    <h3>Akses Cepat</h3>
    <div class="actions">
        <a class="btn btn-primary" href="{{ route('anggota.books.index') }}">Buka Katalog Buku</a>
        <a class="btn btn-secondary" href="{{ route('anggota.borrow.index') }}">Lihat Peminjaman</a>
        <a class="btn btn-secondary" href="{{ route('anggota.returns.index') }}">Lihat Pengembalian</a>
    </div>
</div>
@endsection
