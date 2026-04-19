@extends('layouts.app')

@section('title', 'Pengembalian Buku')
@section('page_title', 'Pengembalian Buku')
@section('page_description', 'Ajukan pengembalian buku dengan tanggal kembali. Petugas akan memeriksa kondisi buku dan menghitung denda otomatis.')

@section('content')
<div class="panel panel--spaced">
    <h3>Ajukan Pengembalian Buku</h3>
    <p class="muted">Isi tanggal pengembalian buku Anda. Petugas akan memverifikasi kondisi buku dan menghitung denda jika ada keterlambatan.</p>

    @php
        $openReturns = $pinjaman->where('status', 'dipinjam');
        $allReturns = $pinjaman->whereIn('status', ['menunggu_acc', 'disetujui', 'selesai']);
    @endphp

    @if($openReturns->isEmpty())
        <div class="panel">Tidak ada buku yang dapat diajukan pengembaliannya saat ini.</div>
    @else
        <div class="grid-2">
            @foreach($openReturns as $item)
                <div class="card">
                    <form action="{{ route('anggota.returns.store', $item) }}" method="POST">
                        @csrf

                        <div class="field">
                            <label>Judul Buku</label>
                            <input type="text" value="{{ $item->judul }}" readonly>
                        </div>

                        <div class="field">
                            <label>Tanggal Pinjam</label>
                            <input type="text" value="{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}" readonly>
                        </div>

                        <div class="field">
                            <label>Batas Kembali</label>
                            <input type="text" value="{{ $item->batas_kembali?->format('d M Y') ?? '-' }}" readonly>
                        </div>

                        <div class="field">
                            <label for="tanggal_dikembalikan_{{ $item->id }}">Tanggal Kembali</label>
                            <input
                                id="tanggal_dikembalikan_{{ $item->id }}"
                                type="date"
                                name="tanggal_dikembalikan"
                                value="{{ now()->format('Y-m-d') }}"
                                min="{{ $item->tanggal_pinjam?->format('Y-m-d') ?? now()->format('Y-m-d') }}"
                                required
                            />
                        </div>

                        <div class="actions">
                            <button class="btn btn-warning" type="submit">Ajukan Pengembalian</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="panel">
    <h3>Status Pengembalian</h3>
    <p class="muted">Riwayat pengajuan pengembalian dan status verifikasi petugas.</p>

    @if($allReturns->isEmpty())
        <div class="panel">Belum ada pengajuan pengembalian.</div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Kondisi</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allReturns as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                            <td>{{ $item->tanggal_dikembalikan?->format('d M Y') ?? '-' }}</td>
                            <td>
                                @if($item->status === 'selesai' && $item->kondisi)
                                    {{ ucfirst($item->kondisi) }}
                                @else
                                    <span class="muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status === 'selesai')
                                    Rp {{ number_format($item->denda_terhitung, 0, ',', '.') }}
                                @else
                                    <span class="muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status === 'menunggu_acc')
                                    <span class="badge warn">Menunggu ACC Petugas</span>
                                @elseif($item->status === 'disetujui')
                                    <span class="badge info">Dalam Verifikasi</span>
                                @elseif($item->status === 'selesai')
                                    <span class="badge success">Selesai - Denda: Rp {{ number_format($item->denda_terhitung, 0, ',', '.') }}</span>
                                @else
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
