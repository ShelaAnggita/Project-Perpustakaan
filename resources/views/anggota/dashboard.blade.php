@extends('layouts.main')

@section('content')

<header class="header">
    <div class="search">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Cari buku...">
    </div>
    <div class="profile">
        <i class="fa fa-user-circle"></i>
    </div>
</header>

<section class="content">
    <h2>Dashboard</h2>

    <div class="cards">
        <div class="card">
            ⭐
            <div>
                <p>Sedang Dipinjam</p>
                <h3>2 Buku</h3>
            </div>
        </div>

        <div class="card">
            ⏰
            <div>
                <p>Hampir Jatuh Tempo</p>
                <h3>0 Buku</h3>
            </div>
        </div>

        <div class="card">
            💰
            <div>
                <p>Denda</p>
                <h3>Rp 0</h3>
            </div>
        </div>
    </div>

    <h3>Rekomendasi Untuk Anda</h3>

    <div class="books">
        <div class="book">
            <img src="{{ asset('image/PAI.jpg') }}">
            <p>Pendidikan Agama</p>
            <div class="btn" style="display: flex; gap: 5px; justify-content: center;">
                <a href="{{ route('detail.buku', 3) }}">
                    <button class="detail">Detail</button>
                </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>

        <div class="book">
            <img src="{{ asset('image/Matematika.jpg') }}">
            <p>Matematika</p>
            <div class="btn" style="display: flex; gap: 5px; justify-content: center;">
                <a href="{{ route('detail.buku', 3) }}">
                    <button class="detail">Detail</button>
                </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>

        <div class="book">
            <img src="{{ asset('image/Dilan.jpg') }}">
            <p>Dilan 1990</p>
            <div class="btn" style="display: flex; gap: 5px; justify-content: center;">
                <a href="{{ route('detail.buku', 3) }}">
                    <button class="detail">Detail</button>
                </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>

        <div class="book">
            <img src="{{ asset('image/Angkasa.jpg') }}">
            <p>Angkasa & 56 Hari</p>
            <div class="btn" style="display: flex; gap: 5px; justify-content: center;">
                <a href="{{ route('detail.buku', 3) }}">
                    <button class="detail">Detail</button>
                </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>
    </div>
</section>

@endsection