@extends('layouts.app')

@section('title', 'Pengembalian')
@section('page_title', 'Pengembalian')
@section('page_description', 'Satu menu untuk ACC pengembalian dan memantau status akhir pengembalian buku anggota.')

@section('content')
<div class="panel" style="margin-bottom:20px;">
    <h3>Menunggu Konfirmasi Pengembalian</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Kondisi</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingReturns as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $item->tanggal_dikembalikan?->format('d M Y') ?? '-' }}</td>
                        <td>{{ isset($item->catatan) ? explode('.', str_replace('Kondisi: ', '', $item->catatan))[0] : '-' }}</td>
                        <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        <td>
                            <div class="actions">
                                <form action="{{ route($panel.'.returns.approve', $item) }}" method="POST" style="display:inline-block; margin-right: 8px;">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">ACC</button>
                                </form>
                                <form action="{{ route($panel.'.returns.reject', $item) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Tolak</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="muted">Tidak ada pengajuan pengembalian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="panel">
    <h3>Data Pengembalian</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returnHistory as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <span class="badge {{ $item->status === 'dikembalikan' ? 'success' : 'info' }}">
                                {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td>{{ $item->tanggal_dikembalikan?->format('d M Y H:i') ?? '-' }}</td>
                        <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="muted">Belum ada data pengembalian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
