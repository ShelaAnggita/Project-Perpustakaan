@extends('layouts.main')

@section('content')

<!-- Header -->
<header class="header">
    <div class="search">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Cari buku...">
    </div>
    <div class="profile">
        <i class="fa fa-user-circle"></i>
    </div>
</header>

<!-- Content -->
<section class="content">
    <h2>Dashboard</h2>

    <!-- Cards -->
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

    <!-- Rekomendasi -->
    <h3>Rekomendasi Untuk Anda</h3>

    <div class="books">
        <div class="book">
            <img src="{{ asset('image/PAI.jpg') }}">
            <div class="btn">
                <p>Pendidikan Agama</p>

            <a href="{{ route('detail.buku', 3) }}">
                <button class="detail">Detail</button>
            </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>

        <div class="book">
            <img src="{{ asset('image/Matematika.jpg') }}">
            <div class="btn">
                <p>Matematika</p>
            <a href="{{ route('detail.buku', 3) }}">
                <button class="detail">Detail</button>
            </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>

        <div class="book">
            <img src="{{ asset('image/Dilan.jpg') }}">
            <div class="btn">
                <p>Dilan 1990</p>
            <a href="{{ route('detail.buku', 3) }}">
                <button class="detail">Detail</button>
            </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>

        <div class="book">
            <img src="{{ asset('image/Angkasa.jpg') }}">
            <div class="btn">
                <p>Angkasa & 56 Hari</p>
            <a href="{{ route('detail.buku', 3) }}">
                <button class="detail">Detail</button>
            </a>
                <button class="pinjam">Pinjam</button>
            </div>
        </div>
    </div>

</section>

@endsection