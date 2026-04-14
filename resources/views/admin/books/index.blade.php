@extends('layouts.app')

@section('title', 'Kelola Buku')
@section('page_title', 'Kelola Buku')
@section('page_description', 'CRUD buku untuk petugas dan kepala perpustakaan.')

@section('content')
<div class="panel">
    <div class="actions" style="justify-content:space-between; margin-bottom:16px;">
        <form method="GET" style="display:flex; gap:8px; flex-wrap:wrap;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari buku">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
        @if($panel === 'petugas')
            <a class="btn btn-primary" href="{{ route($panel.'.books.create') }}">Tambah Buku</a>
        @endif
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->category->nama ?? 'Tanpa Kategori' }}</td>
                        <td>{{ $book->penulis }}</td>
                        <td>
                            <div>{{ $book->stok_tersedia }} / {{ $book->stok }}</div>
                            @if($book->stok_tersedia < $book->stok)
                                <div class="muted">Buku sedang dipinjam</div>
                            @endif
                        </td>
                        <td class="actions">
                            @if($panel === 'petugas')
                                <a class="btn btn-secondary" href="#">Edit</a>
                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            @else
                                <span class="muted">Lihat saja</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="muted">Belum ada buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($books->hasPages())
        <div style="margin-top:20px;">
            {{ $books->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
