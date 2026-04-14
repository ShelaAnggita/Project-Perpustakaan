@extends('layouts.app') 

@section('title', 'Koleksi Buku Petugas')
@section('page_title', 'Koleksi Buku')
@section('page_description', 'Kelola daftar buku serta stok koleksi perpustakaan.')

@section('content')
  
<div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Koleksi Buku</h2>
    <div style="display: flex; align-items: center; gap: 12px;">
        @if($books->hasPages())
            <div style="display: flex; gap: 6px; align-items: center;">
                @if($books->onFirstPage())
                    <span style="color: #ccc; cursor: not-allowed; font-size: 18px;">←</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" style="color: #4a90e2; text-decoration: none; font-size: 18px;">←</a>
                @endif
                <span style="color: #666; font-size: 12px;">{{ $books->currentPage() }} / {{ $books->lastPage() }}</span>
                @if($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" style="color: #4a90e2; text-decoration: none; font-size: 18px;">→</a>
                @else
                    <span style="color: #ccc; cursor: not-allowed; font-size: 18px;">→</span>
                @endif
            </div>
        @endif
        <a href="{{ route('petugas.books.create') }}" class="btn-tambah" style="background-color: #0f766e; padding: 10px 16px; border-radius: 8px; text-decoration: none; color: white; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa fa-plus"></i> Tambah
        </a>
    </div>
</div>

<div class="books" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
    @foreach($books as $book)
    <div class="book-card" style="background: white; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <img src="{{ asset('image/' . ($book->gambar ?? 'downloadremove.png')) }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
        <p style="font-weight: bold; margin: 10px 0;">{{ $book->judul }}</p>
        <p style="color: #666; font-size: 14px; margin: 5px 0;">{{ $book->penulis }}</p>
        <p style="color: #888; font-size: 12px;">Stok: {{ $book->stok_tersedia }}/{{ $book->stok }}</p>

        <div class="actions" style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; margin-top: 12px; padding-top: 12px; border-top: 1px solid #eee;">
            <a href="{{ route('petugas.books.show', $book) }}" class="btn" style="background-color: #e2c14a; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                <i class="fa fa-eye"></i> Detail
            </a>
            <a href="{{ route('petugas.books.edit', $book) }}" class="btn" style="background-color: #4a90e2; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                <i class="fa fa-edit"></i> Edit
            </a>
            <form action="{{ route('petugas.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background-color: #e24a4a; color: white; padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; font-weight: 600; cursor: pointer;">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection