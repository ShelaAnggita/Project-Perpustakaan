@extends('layouts.app')

@section('title', 'Kategori Buku')
@section('page_title', 'Kategori Buku')
@section('page_description', 'Kategori sederhana dengan tampilan ringkas dan tetap bisa dikelola.')

@section('content')
<div class="panel" style="margin-bottom:20px;">
    @if($panel === 'petugas')
        <form action="{{ route($panel.'.categories.store') }}" method="POST" class="actions" style="align-items:end; margin-bottom:0;">
            @csrf
            <div class="field" style="flex:1; margin-bottom:0;">
                <label>Nama Kategori</label>
                <input type="text" name="nama" required>
            </div>
            <button class="btn btn-primary" type="submit">Tambah</button>
        </form>
    @endif
</div>

<div class="books">
    @forelse($categories as $category)
        <div class="panel">
            <div style="display:flex; justify-content:space-between; gap:12px; align-items:flex-start; margin-bottom:14px;">
                <div>
                    <h3 style="margin-bottom:6px;">{{ $category->nama }}</h3>
                    <div class="muted">{{ $category->books_count }} buku</div>
                </div>
                @if($panel !== 'petugas')
                    <span class="badge info">Lihat</span>
                @endif
            </div>

            @if($panel === 'petugas')
                <form action="{{ route($panel.'.categories.update', $category) }}" method="POST" class="actions" style="margin-bottom:10px;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nama" value="{{ $category->nama }}" aria-label="Nama kategori {{ $category->nama }}">
                    <button class="btn btn-secondary" type="submit">Simpan</button>
                </form>
                <form action="{{ route($panel.'.categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            @endif
        </div>
    @empty
        <div class="panel">Belum ada kategori.</div>
    @endforelse
</div>
@endsection
