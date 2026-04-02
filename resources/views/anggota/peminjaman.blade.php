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
    <h2>Peminjaman Saya</h2>

    <div class="books">


        <div class="book">
            <img src="{{ asset('image/Sejarah.jpg') }}">
            <p>Hujan</p>

            <div class="btn">
                <button class="detail">Detail</button>
                <button class="kembali">Kembalikan</button>
            </div>
        </div>

        <!-- Buku 2 -->
        <div class="book">
            <img src="{{ asset('image/LaskarPelangi.jpg') }}">
            <p>Laskar Pelangi</p>

            <div class="btn">
                <button class="detail">Detail</button>
                <button class="kembali">Kembalikan</button>
            </div>
        </div>

    </div>
</section>

@endsection