@extends('layouts.app')

@section('title', 'Pengembalian Buku')
@section('page_title', 'Pengembalian Buku')
@section('page_description', 'Pengajuan pengembalian akan diperiksa petugas. Jika telat, denda muncul saat petugas memproses.')

@section('content')
<div class="panel panel--spaced">
    <h3>Pengembalian Buku</h3>
    <p class="muted">Isi pengembalian dengan tanggal kembali dan kondisi buku. Denda otomatis dihitung sesuai aturan.</p>

    @php
        $openReturns = $pinjaman->where('status', 'dipinjam');
        $waitingReturns = $pinjaman->where('status', 'menunggu_pengembalian');
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
                            <label for="tanggal_dikembalikan_{{ $item->id }}">Tanggal Kembali</label>
                            <input
                                id="tanggal_dikembalikan_{{ $item->id }}"
                                type="date"
                                name="tanggal_dikembalikan"
                                value="{{ now()->format('Y-m-d') }}"
                                min="{{ $item->tanggal_pinjam?->format('Y-m-d') ?? now()->format('Y-m-d') }}"
                                onchange="updateEstimasiDenda({{ $item->id }})"
                                oninput="updateEstimasiDenda({{ $item->id }})"
                                required
                            />
                        </div>

                        <div class="field">
                            <label for="kondisi_{{ $item->id }}">Kondisi Buku</label>
                            <select
                                id="kondisi_{{ $item->id }}"
                                name="kondisi"
                                onchange="updateEstimasiDenda({{ $item->id }})"
                                required
                            >
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                                <option value="hilang">Hilang</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Estimasi Denda</label>
                            <p><strong id="estimasi_denda_{{ $item->id }}">Rp 0</strong></p>
                        </div>

                        <div class="actions">
                            <button class="btn btn-warning" type="submit">Ajukan Pengembalian</button>
                        </div>

                        <input type="hidden" id="batas_kembali_{{ $item->id }}" value="{{ $item->batas_kembali?->format('Y-m-d') ?? '' }}" />
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="panel">
    <h3>Status Pengembalian</h3>
    <p class="muted">Riwayat dan pengajuan yang sedang menunggu ACC petugas.</p>

    @if($waitingReturns->isEmpty())
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
                    @foreach($waitingReturns as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->tanggal_pinjam?->format('d M Y') ?? '-' }}</td>
                            <td>{{ $item->tanggal_dikembalikan?->format('d M Y') ?? '-' }}</td>
                            <td>{{ isset($item->catatan) ? explode('.', str_replace('Kondisi: ', '', $item->catatan))[0] : '-' }}</td>
                            <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                            <td><span class="badge warn">Menunggu ACC Petugas</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    function updateEstimasiDenda(id) {
        const tglKembali = document.getElementById(`tanggal_dikembalikan_${id}`)?.value;
        const kondisi = document.getElementById(`kondisi_${id}`)?.value;
        const batas = document.getElementById(`batas_kembali_${id}`)?.value;
        const estimasi = document.getElementById(`estimasi_denda_${id}`);

        if (!estimasi || !tglKembali || !kondisi) {
            return;
        }

        function parseDateYMD(value) {
            const [year, month, day] = value.split('-').map(Number);
            return new Date(year, month - 1, day);
        }

        let denda = 0;

        if (kondisi === 'baik' && batas) {
            const kembali = parseDateYMD(tglKembali);
            const batasKembali = parseDateYMD(batas);
            const diffTime = kembali - batasKembali;
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            if (diffDays > 0) {
                denda = diffDays * 2000;
            }
        } else if (kondisi === 'rusak') {
            denda = 30000;
        } else if (kondisi === 'hilang') {
            denda = 100000;
        }

        estimasi.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(denda);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="tanggal_dikembalikan_"]').forEach(input => {
            const id = input.id.replace('tanggal_dikembalikan_', '');
            updateEstimasiDenda(id);
        });
    });
</script>
@endsection
