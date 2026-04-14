@extends('layouts.app')

@section('title', 'Laporan Peminjaman')
@section('page_title', 'Laporan')
@section('page_description', 'Ringkasan transaksi peminjaman dan pengembalian semua anggota.')

@section('content')
<div class="panel" style="margin-bottom:20px; display: flex; flex-wrap: wrap; gap: 12px; justify-content: space-between; align-items: center;">
    <form method="GET" class="actions" style="flex: 1; display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
        <select name="status">
            <option value="">Semua status</option>
            <option value="menunggu_persetujuan" @selected($statusAktif === 'menunggu_persetujuan')>Menunggu Persetujuan</option>
            <option value="dipinjam" @selected($statusAktif === 'dipinjam')>Dipinjam</option>
            <option value="menunggu_pengembalian" @selected($statusAktif === 'menunggu_pengembalian')>Menunggu Pengembalian</option>
            <option value="dikembalikan" @selected($statusAktif === 'dikembalikan')>Dikembalikan</option>
            <option value="ditolak" @selected($statusAktif === 'ditolak')>Ditolak</option>
        </select>
        <button class="btn btn-primary" type="submit">Filter</button>
        <a class="btn btn-secondary" href="{{ route('kepala.reports.index') }}">Reset</a>
    </form>
    <button class="btn btn-primary" type="button" onclick="window.print()">Cetak Laporan</button>
</div>

<div class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        <td>{{ $row->user->nama_lengkap ?? '-' }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $row->status)) }}</td>
                        <td>{{ $row->tanggal_pinjam?->format('d M Y H:i') ?? '-' }}</td>
                        <td>Rp {{ number_format($row->denda_terhitung, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="muted">Belum ada data laporan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
