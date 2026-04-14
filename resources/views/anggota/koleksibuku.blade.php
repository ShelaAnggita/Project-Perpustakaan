@extends('layouts.app')

@section('title', 'Koleksi Buku')
@section('page_title', 'Koleksi Buku')
@section('page_description', 'Anggota dapat meminjam maksimal 3 buku aktif dan tidak bisa meminjam judul yang sama secara bersamaan.')

@section('content')
@php $batasAktif = $activeLoanCount >= 3; @endphp

<div class="panel panel--spaced">
    <div class="muted" style="margin-bottom:14px;">Buku aktif yang sedang Anda proses atau pinjam: {{ $activeLoanCount }} dari 3.</div>
    <form class="grid-2" method="GET">
        <div class="field">
            <label>Cari buku</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Judul, penulis, atau penerbit">
        </div>
        <div class="field">
            <label>Kategori</label>
            <select name="category">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="actions">
            <button class="btn btn-primary" type="submit">Filter</button>
            <a class="btn btn-secondary" href="{{ route('anggota.books.index') }}">Reset</a>
            <div class="pagination-actions">
                <a class="btn btn-secondary btn-icon" href="{{ request()->fullUrlWithQuery(['page' => max(1, $books->currentPage() - 1)]) }}" aria-label="Halaman sebelumnya" @if($books->onFirstPage()) style="opacity:.5; pointer-events:none;" @endif>‹</a>
                <span class="pagination-label">{{ $books->currentPage() }} / {{ $books->lastPage() }}</span>
                <a class="btn btn-secondary btn-icon" href="{{ request()->fullUrlWithQuery(['page' => $books->currentPage() + 1]) }}" aria-label="Halaman selanjutnya" @if(!$books->hasMorePages()) style="opacity:.5; pointer-events:none;" @endif>›</a>
            </div>
        </div>
    </form>
</div>

<div class="books">
    @forelse($books as $book)
        @php
            $sedangDipinjam = in_array($book->id, $loanedBookIds, true);
            $disablePinjam = $sedangDipinjam || $batasAktif || $book->stok_tersedia < 1;
        @endphp
        <div class="book-card">
            <img class="book-cover" src="{{ $book->gambar ? asset('image/'.$book->gambar) : asset('image/downloadremove.png') }}" alt="{{ $book->judul }}">
            <div class="book-body">
                <div>
                    <div class="badge info">{{ $book->category->nama ?? 'Tanpa Kategori' }}</div>
                    <h3>{{ $book->judul }}</h3>
                    <div class="muted">{{ $book->penulis }} • Stok tersedia {{ $book->stok_tersedia }}</div>
                    @if($book->stok_tersedia < $book->stok)
                        <div class="muted">Buku sedang dipinjam.</div>
                    @endif
                </div>
                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('anggota.books.show', $book->id) }}">Detail</a>
                    <form action="{{ route('anggota.borrow.store', $book->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit" @disabled($disablePinjam)>{{ $disablePinjam ? 'Tidak Bisa Dipinjam' : 'Pinjam' }}</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="panel">Belum ada buku.</div>
    @endforelse
</div>


@endsection
