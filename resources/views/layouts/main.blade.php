<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            📖 <span>PERPUSTAKAAN DIGITAL</span>
        </div>

        <ul class="menu">
            <li><a href="{{ route('dashboard-anggota') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('koleksi-buku') }}"><i class="fa fa-book"></i> Koleksi Buku</a></li>
            <li><a href="/peminjaman"><i class="fa fa-user"></i> Peminjaman Saya</a></li>
            <li><a href="/peminjaman"><i class="fa fa-undo"></i> Pengembalian</a></li>
            <li><a href="/riwayat"><i class="fa fa-history"></i> Riwayat Peminjaman</a></li>
            <li><a href="/riwayat"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <!-- Main -->
    <main class="main">
        @yield('content')
    </main>

</div>

</body>
</html>