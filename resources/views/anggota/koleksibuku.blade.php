@extends('layouts.main')

@section('content')

<h2>Koleksi Buku</h2>

<div class="books">
    <div class="book">
        <span class="stock-tag">Stok: 5</span> 
        
        <img src="{{ asset('image/Dilan.jpg') }}">
        <p>Dilan 1990</p>

        <a href="{{ route('detail.buku', 1) }}">
            <button class="detail">Detail</button>
        </a>
        <button class="pinjam">Pinjam</button>
    </div>

    <div class="book">
        <span class="stock-tag">Stok: 2</span>

        <img src="{{ asset('image/Angkasa.jpg') }}">
        <p>Angkasa & 65 Hari</p>

        <a href="{{ route('detail.buku', 2) }}">
            <button class="detail">Detail</button>
        </a>
        <button class="pinjam">Pinjam</button>
    </div>

    <div class="book">
        <span class="stock-tag">Stok: 0</span>

        <img src="{{ asset('image/PendidikanAgama.jpg') }}">
        <p>Pendidikan Agama</p>

        <a href="{{ route('detail.buku', 3) }}">
            <button class="detail">Detail</button>
        </a>
        <button class="pinjam">Pinjam</button>
    </div>

    <div class="book">
        <span class="stock-tag">Stok: 0</span>

        <img src="{{ asset('image/Angkasa.jpg') }}">
        <p>Angkasa</p>

        <a href="{{ route('detail.buku', 3) }}">
            <button class="detail">Detail</button>
        </a>
        <button class="pinjam">Pinjam</button>
    </div>
</div>

@endsection