@extends('layouts.main')

@section('content')

<header class="header">
    <div class="search">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Cari data pengembalian...">
    </div>
    <div class="profile">
        <i class="fa fa-user-circle"></i>
    </div>
</header>

<section class="content">
    <h2>Form Pengembalian Buku</h2>
    <p>Berikut adalah daftar buku yang sedang Anda pinjam. Silakan klik tombol kembalikan jika ingin mengembalikan buku.</p>

    <div class="table-container" style="background: white; padding: 20px; border-radius: 10px; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #f4f4f4; text-align: left;">
                    <th style="padding: 12px;">Cover</th>
                    <th style="padding: 12px;">Judul Buku</th>
                    <th style="padding: 12px;">Tanggal Pinjam</th>
                    <th style="padding: 12px;">Batas Kembali</th>
                    <th style="padding: 12px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjaman as $item)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">
                        <img src="{{ asset('image/' . $item->book->gambar) }}" width="50" style="border-radius: 5px;">
                    </td>
                    <td style="padding: 12px; font-weight: bold;">{{ $item->book->judul }}</td>
                    <td style="padding: 12px;">{{ $item->tanggal_pinjam }}</td>
                    <td style="padding: 12px;">{{ $item->tanggal_kembali }}</td>
                    <td style="padding: 12px;">
                        <form action="{{ route('proses-kembali', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="pinjam" style="background-color: #e74c3c; border: none; padding: 8px 15px; color: white; border-radius: 5px; cursor: pointer;">
                                <i class="fa fa-undo"></i> Kembalikan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #888;">
                        Anda tidak memiliki pinjaman buku yang aktif.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

@endsection