<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Perpustakaan Digital</title>
    <link rel="stylesheet" href="{{ asset ('css/style.css') }}">
    <!-- Mengambil font Inter & FontAwesome untuk ikon -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sisi Kiri: Hero & Informasi -->
        <div class="left-side">
            <div class="logo">
                <i class="fas fa-book-open"></i>
                <span>PERPUSTAKAAN DIGITAL</span>
            </div>
            <div class="hero-text">
                <h1>Buat Akun Perpustakaan Digital</h1>
                <p>Daftar untuk mengakses ribuan buku digital</p>
            </div>
            <div class="hero-image">
                <img src="{{ asset ('image/downloadremove.png') }}">
            </div>
        </div>

        <!-- Sisi Kanan: Form Registrasi -->
        <div class="right-side">
            <div class="form-box">
                <h2>Registrasi</h2>
                <p class="subtitle">Silahkan buat akun Anda</p>

                <form action="{{ route('register.store') }}" method="POST">
    @csrf

    <!-- TAMBAHKAN INI UNTUK MELIHAT ERROR JIKA GAGAL REDIRECT -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="input-group">
        <label>Nama Lengkap</label>
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nama Anda" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
        </div>
    </div>

    <div class="input-group">
        <label>Email</label>
        <div class="input-container">
            <i class="fas fa-envelope"></i>
            <!-- PERBAIKAN: Dari nama="email" menjadi name="email" -->
            <input type="email" placeholder="contoh@gmail.com" name="email" value="{{ old('email') }}">
        </div>
    </div>

    <div class="input-group">
        <label>Password</label>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="........." name="password">
        </div>
    </div>

    <div class="input-group">
        <label>Konfirmasi Password</label>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="........." name="password_confirmation">
        </div>
    </div>

    <button type="submit" class="btn-daftar">Daftar</button>
</form>

                <p class="login-redirect">Sudah punya akun? <a href="#">Masuk</a></p>
            </div>
        </div>
    </div>
</body>
</html>