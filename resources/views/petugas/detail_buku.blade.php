@extends('layouts.app')

@section('title', 'Detail Buku')
@section('page_title', 'Detail Buku')
@section('page_description', 'Informasi lengkap buku di koleksi perpustakaan.')

@section('content')
<div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Detail Buku</h2>
    <a href="{{ route('petugas.books.index') }}" style="background-color: #888; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">← Kembali</a>
</div>

<div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <div style="display: grid; grid-template-columns: 250px 1fr; gap: 30px;">
        <!-- Image -->
        <div>
            <img src="{{ asset('image/' . ($book->gambar ?? 'downloadremove.png')) }}" style="width: 100%; height: 350px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        </div>

        <!-- Details -->
        <div>
            <h2 style="margin: 0 0 10px 0;">{{ $book->judul }}</h2>
            
            <div style="color: #666; font-size: 14px; margin-bottom: 20px;">
                <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
                <p><strong>Pengarang:</strong> {{ $book->pengarang ?? '-' }}</p>
                <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
                <p><strong>Kategori:</strong> 
                    @if($book->category)
                        <span style="background: #e7f0ff; color: #4a90e2; padding: 4px 10px; border-radius: 4px;">{{ $book->category->nama }}</span>
                    @else
                        <span>-</span>
                    @endif
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 30px;">
                <div style="background: #f0f0f0; padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="color: #888; font-size: 12px; margin-bottom: 8px;">Total Stok</div>
                    <div style="font-size: 28px; font-weight: bold; color: #333;">{{ $book->stok }}</div>
                </div>
                <div style="background: #f0f0f0; padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="color: #888; font-size: 12px; margin-bottom: 8px;">Stok Tersedia</div>
                    <div style="font-size: 28px; font-weight: bold; color: #4ae24a;">{{ $book->stok_tersedia }}</div>
                </div>
                <div style="background: #f0f0f0; padding: 15px; border-radius: 8px; text-align: center;">
                    <div style="color: #888; font-size: 12px; margin-bottom: 8px;">Sedang Dipinjam</div>
                    <div style="font-size: 28px; font-weight: bold; color: #e24a4a;">{{ $book->stok - $book->stok_tersedia }}</div>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <h3 style="margin: 0 0 10px 0;">Deskripsi</h3>
                <p style="color: #555; line-height: 1.6;">{{ $book->deskripsi }}</p>
            </div>

            <div style="display: flex; gap: 10px; padding-top: 20px; border-top: 1px solid #eee;">
                <a href="{{ route('petugas.books.edit', $book) }}" style="background-color: #4a90e2; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <form action="{{ route('petugas.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #e24a4a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection