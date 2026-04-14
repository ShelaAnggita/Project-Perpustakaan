@extends('layouts.app')

@section('title', 'Edit Buku')
@section('page_title', 'Edit Buku')
@section('page_description', 'Perbarui data buku koleksi perpustakaan.')

@section('content')
<div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Edit Buku</h2>
</div>

<div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <form action="{{ route('petugas.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Kategori</label>
                <select name="category_id" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Pengarang</label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $book->stok) }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Cover Buku</label>
                <input type="file" name="gambar" accept=".jpg,.jpeg,.png" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi</label>
            <textarea name="deskripsi" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; min-height: 100px;">{{ old('deskripsi', $book->deskripsi) }}</textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Simpan Perubahan</button>
            <a href="{{ route('petugas.books.index') }}" style="background-color: #f44336; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Batal</a>
        </div>
    </form>
</div>
@endsection