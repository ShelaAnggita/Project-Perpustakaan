@extends('layouts.app')

@section('title', 'Detail Buku')
@section('page_title', 'Detail Buku')
@section('page_description', 'Lihat informasi lengkap buku sebelum meminjam.')

@section('content')
<div class="grid-2">
    <div class="panel">
        <img class="book-cover" src="{{ $book->gambar ? asset('image/'.$book->gambar) : asset('image/downloadremove.png') }}" alt="{{ $book->judul }}">
    </div>
    <div class="panel">
        <div class="badge info">{{ $book->category->nama ?? 'Tanpa Kategori' }}</div>
        <h2>{{ $book->judul }}</h2>
        <p class="muted">{{ $book->penulis }}</p>
        <p>{{ $book->deskripsi }}</p>
        <div class="field"><strong>Penerbit</strong><div>{{ $book->penerbit ?? '-' }}</div></div>
        <div class="field"><strong>Tahun Terbit</strong><div>{{ $book->tahun_terbit ?? '-' }}</div></div>
        <div class="field"><strong>Stok</strong><div>{{ $book->stok_tersedia }} dari {{ $book->stok }}</div></div>
        @if($book->stok_tersedia < $book->stok)
            <div class="muted" style="margin-bottom:14px;">Buku sedang dipinjam anggota lain.</div>
        @endif
        <div class="actions">
            <a class="btn btn-secondary" href="{{ route('anggota.books.index') }}">Kembali</a>
            <form action="{{ route('anggota.borrow.store', $book) }}" method="POST">
                @csrf
                <button class="btn btn-primary" type="submit" @disabled($punyaPinjamanAktif || $sudahMaksimalPinjam || $book->stok_tersedia < 1)>{{ $punyaPinjamanAktif ? 'Sudah Dipinjam' : ($sudahMaksimalPinjam ? 'Maksimal 3 Buku' : ($book->stok_tersedia < 1 ? 'Tidak Tersedia' : 'Pinjam Buku')) }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
