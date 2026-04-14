@extends('layouts.app')

@section('title', 'Peminjaman Saya')
@section('page_title', 'Peminjaman Saya')
@section('page_description', 'Status peminjaman akan berubah setelah dikonfirmasi petugas.')

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->judul }}</strong>
                            <div class="muted">{{ $item->book->penulis ?? '-' }}</div>
                        </td>
                        <td><span class="badge {{ $item->status === 'dipinjam' ? 'success' : ($item->status === 'ditolak' ? 'danger' : 'info') }}">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span></td>
                        <td>{{ $item->tanggal_pinjam?->format('d M Y H:i') ?? '-' }}</td>
                        <td>{{ $item->batas_kembali?->format('d M Y H:i') ?? '-' }}</td>
                        <td>Rp {{ number_format($item->denda_terhitung, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="muted">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
