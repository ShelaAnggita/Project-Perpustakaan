@extends('layouts.kepala') 

@section('content')
  
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Koleksi Buku</h2>
    @if($books->hasPages())
        <div style="display: flex; gap: 6px; align-items: center;">
            @if($books->onFirstPage())
                <span style="color: #ccc; cursor: not-allowed; font-size: 18px;">←</span>
            @else
                <a href="{{ $books->previousPageUrl() }}" style="color: #0f766e; text-decoration: none; font-size: 18px;">←</a>
            @endif
            <span style="color: #666; font-size: 12px;">{{ $books->currentPage() }} / {{ $books->lastPage() }}</span>
            @if($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}" style="color: #0f766e; text-decoration: none; font-size: 18px;">→</a>
            @else
                <span style="color: #ccc; cursor: not-allowed; font-size: 18px;">→</span>
            @endif
        </div>
    @endif
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
    @foreach($books as $book)
    <div style="background: white; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <img src="{{ asset('image/' . ($book->gambar ?? 'downloadremove.png')) }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
        <p style="font-weight: bold; margin: 10px 0;">{{ $book->judul }}</p>
        <p style="color: #666; font-size: 14px; margin: 5px 0;">{{ $book->penulis }}</p>
        <p style="color: #888; font-size: 12px;">Stok: {{ $book->stok_tersedia }}/{{ $book->stok }}</p>

        <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; margin-top: 12px; padding-top: 12px; border-top: 1px solid #eee;">
            <a href="{{ route('kepala.books.show', $book) }}" class="btn" style="background-color: #0f766e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600;">
                <i class="fa fa-eye"></i> Detail
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection