@extends('layouts.app')

@section('title', 'Pengembalian')
@section('page_title', 'Pengembalian')
@section('page_description', 'Menu untuk mengelola pengajuan pengembalian buku: approval, verifikasi kondisi, dan perhitungan denda otomatis.')

@section('content')
<!-- Step 1: Pending Approvals -->
<div class="panel" style="margin-bottom:20px;">
    <h3>1. Pengajuan Menunggu ACC (Menunggu Persetujuan Awal)</h3>
    <p class="muted">Anggota mengajukan pengembalian. Verifikasi tanggal kembali dan setujui pengajuan.</p>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Tanggal Kembali (Diajukan)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingApprovals as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $item->batas_kembali?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $item->tanggal_dikembalikan?->format('d M Y') ?? '-' }}</td>
                        <td>
                            <div class="actions">
                                <form action="{{ route($panel.'.returns.approve', $item) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-warning" type="submit" title="Setujui pengajuan pengembalian">Setujui</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="muted">Tidak ada pengajuan pengembalian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Step 2: Pending Condition Verification -->
<div class="panel" style="margin-bottom:20px;">
    <h3>2. Verifikasi Kondisi Buku (Dalam Proses)</h3>
    <p class="muted">Petugas memverifikasi kondisi buku (baik, rusak, hilang) dan sistem otomatis menghitung denda.</p>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingVerifications as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $item->tanggal_dikembalikan?->format('d M Y') ?? '-' }}</td>
                        <td>
                            <form action="{{ route($panel.'.returns.verify', $item) }}" method="POST" style="display:inline-flex; gap: 5px;">
                                @csrf
                                <select name="kondisi" class="form-control" style="flex: 1;" required>
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak (+Rp 30.000)</option>
                                    <option value="hilang">Hilang (+Rp 100.000)</option>
                                </select>
                                <button type="submit" class="btn btn-success" title="Verifikasi kondisi dan hitung denda">Verifikasi</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="muted">Tidak ada pengembalian yang perlu diverifikasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Step 3: Completed Returns with Final Fine -->
<div class="panel">
    <h3>3. Pengembalian Selesai (Denda Sudah Dihitung)</h3>
    <p class="muted">Pengembalian yang sudah selesai diverifikasi dengan denda akhir sudah dihitung.</p>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam - Kembali</th>
                    <th>Kondisi</th>
                    <th>Denda Akhir</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returnHistory as $item)
                    <tr>
                        <td>{{ $item->user->nama_lengkap ?? 'Anggota tidak ditemukan' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            {{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }} 
                            s/d 
                            {{ $item->tanggal_dikembalikan?->format('d M Y') ?? '-' }}
                        </td>
                        <td>
                            @if($item->kondisi)
                                <span class="badge {{ $item->kondisi === 'baik' ? 'success' : ($item->kondisi === 'rusak' ? 'warn' : 'danger') }}">
                                    {{ ucfirst($item->kondisi) }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <strong>Rp {{ number_format($item->denda_terhitung, 0, ',', '.') }}</strong>
                        </td>
                        <td>{{ $item->updated_at?->format('d M Y H:i') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="muted">Belum ada pengembalian yang selesai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
