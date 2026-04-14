@extends('layouts.app')

@section('title', $book->exists ? 'Edit Buku' : 'Tambah Buku')
@section('page_title', $book->exists ? 'Edit Buku' : 'Tambah Buku')
@section('page_description', 'Lengkapi data buku, detail, stok, dan cover.')

@section('content')
<div class="panel">
    <form action="{{ $book->exists ? route($panel.'.books.update', $book) : route($panel.'.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($book->exists)
            @method('PUT')
        @endif
        <div class="grid-2">
            <div class="field">
                <label>Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" required>
            </div>
            <div class="field">
                <label>Kategori</label>
                <select name="category_id">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}" required>
            </div>
            <div class="field">
                <label>Pengarang</label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}">
            </div>
            <div class="field">
                <label>Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required>
            </div>
            <div class="field">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" required>
            </div>
            <div class="field">
                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $book->stok) }}" required>
            </div>
            <div class="field">
                <label>Cover Buku</label>
                <input type="file" name="gambar" accept=".jpg,.jpeg,.png">
            </div>
        </div>
        <div class="field">
            <label>Deskripsi</label>
            <textarea name="deskripsi" required>{{ old('deskripsi', $book->deskripsi) }}</textarea>
        </div>
        <div class="actions">
            <button class="btn btn-primary" type="submit">{{ $book->exists ? 'Simpan Perubahan' : 'Tambah Buku' }}</button>
            <a class="btn btn-secondary" href="{{ route($panel.'.books.index') }}">Batal</a>
        </div>
    </form>
</div>
@endsection
