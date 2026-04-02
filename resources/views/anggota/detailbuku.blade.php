@extends('layouts.main')

@section('content')

<header class="header">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('koleksi-buku') }}" style="text-decoration: none; color: #333; font-size: 20px;">
            <i class="fa fa-arrow-left"></i>
        </a>
        <h2 style="margin: 0;">Detail Buku</h2>
    </div>
</header>

<section class="content">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('koleksi-buku') }}" class="detail" style="text-decoration: none; display: inline-block;">
            <i class="fa fa-chevron-left"></i> Kembali ke Koleksi
        </a>
    </div>

    <div class="detail-container">
        <div class="detail-image">
            <img src="{{ asset('image/' . $book['gambar']) }}">
        </div>

        <div class="detail-info">
            <h2>{{ $book['judul'] }}</h2>

        <div class="info-item">
            <span class="label">Penulis</span>
            <span class="value">: {{ $book['penulis'] ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Tahun Terbit</span>
            <span class="value">: {{ $book['tahun'] ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Stok</span>
            <span class="value">: {{ $book['stok'] ?? '-' }}</span>
        </div>

            <br>

            <form action="#" method="POST">
                @csrf
                <button class="pinjam">Pinjam Buku</button>
            </form>
        </div>
    </div>
</section>

@endsection