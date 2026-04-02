@extends('layouts.main')

@section('content')

<h2>Koleksi Buku</h2>

<div class="books">
    <div class="book">
        <span class="stock-tag">Stok: 5</span>
        <img src="{{ asset('image/Dilan.jpg') }}">
        <p>Dilan 1990</p>

        <div class="actions" style="display: flex; justify-content: center; gap: 5px;">
            <a href="{{ route('detail.buku', 1) }}">
                <button type="button" class="detail">Detail</button>
            </a>

            <form action="{{ route('pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="judul" value="Dilan 1990">
                <input type="hidden" name="gambar" value="Dilan.jpg">
                <button type="submit" class="pinjam">Pinjam</button>
            </form>
        </div>
    </div>

    <div class="book">
        <span class="stock-tag">Stok: 2</span>
        <img src="{{ asset('image/Angkasa.jpg') }}">
        <p>Angkasa & 65 Hari</p>

        <div class="actions" style="display: flex; justify-content: center; gap: 5px;">
            <a href="{{ route('detail.buku', 1) }}">
                <button type="button" class="detail">Detail</button>
            </a>

            <form action="{{ route('pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="judul" value="Dilan 1990">
                <input type="hidden" name="gambar" value="Dilan.jpg">
                <button type="submit" class="pinjam">Pinjam</button>
            </form>
        </div>
    </div>

    <div class="book">
        <span class="stock-tag">Stok: 0</span>
        <img src="{{ asset('image/PendidikanAgama.jpg') }}">
        <p>Pendidikan Agama</p>

        <div class="actions" style="display: flex; justify-content: center; gap: 5px;">
            <a href="{{ route('detail.buku', 1) }}">
                <button type="button" class="detail">Detail</button>
            </a>

            <form action="{{ route('pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="judul" value="Dilan 1990">
                <input type="hidden" name="gambar" value="Dilan.jpg">
                <button type="submit" class="pinjam">Pinjam</button>
            </form>
        </div>
    </div>

    <div class="book">
        <span class="stock-tag">Stok: 0</span>
        <img src="{{ asset('image/Angkasa.jpg') }}">
        <p>Angkasa</p>

        <div class="actions" style="display: flex; justify-content: center; gap: 5px;">
            <a href="{{ route('detail.buku', 1) }}">
                <button type="button" class="detail">Detail</button>
            </a>

            <form action="{{ route('pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="judul" value="Dilan 1990">
                <input type="hidden" name="gambar" value="Dilan.jpg">
                <button type="submit" class="pinjam">Pinjam</button>
            </form>
        </div>
    </div>
</div>

@endsection