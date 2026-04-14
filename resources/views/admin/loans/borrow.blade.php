@extends('layouts.app')

@section('title', 'Peminjaman')
@section('page_title', 'Peminjaman')
@section('page_description', 'Satu menu untuk ACC permintaan pinjam dan memantau semua buku yang sedang dipinjam anggota.')

@section('content')
<div class="panel" style="margin-bottom:20px;">
    <h3>Menunggu Konfirmasi</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Stok Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingBorrows as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->book->stok_tersedia ?? 0 }}</td>
                        <td class="actions">
                            <form action="{{ route($panel.'.borrow.approve', $item) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">ACC</button>
                            </form>
                            <form action="{{ route($panel.'.borrow.reject', $item) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="muted">Tidak ada permintaan pinjam.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="panel">
    <h3>Data Peminjaman Aktif</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Denda Berjalan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activeLoans as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <span class="badge {{ $item->status === 'dipinjam' ? 'success' : 'warn' }}">
                                {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td>{{ $item->tanggal_pinjam?->format('d M Y H:i') ?? '-' }}</td>
                        <td>{{ $item->batas_kembali?->format('d M Y H:i') ?? '-' }}</td>
                        <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="muted">Belum ada peminjaman aktif.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
