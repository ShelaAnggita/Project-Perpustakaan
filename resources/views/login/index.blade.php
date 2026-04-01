<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
    <link rel="stylesheet" href="{{ asset ('css/style.css') }}">
    <!-- Menggunakan Font Inter untuk kemiripan desain -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Library Ikon (FontAwesome) untuk amplop dan mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <!-- Bagian Kiri (Hero/Visual) -->
        <div class="left-section">
            <div class="brand">
                <i class="fas fa-book-open"></i>
                <span>PERPUSTAKAAN DIGITAL</span>
            </div>
            <div class="hero-content">
                <h1>Selamat Datang</h1>
                <h2>di Sistem Perpustakaan Digital</h2>
                <p>Akses ribuan buku dalam genggaman Anda</p>
                <img src="{{ asset ('image/downloadremove.png') }}">
            </div>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="right-section">
            <div class="login-box">
                <h3>Login</h3>
                <p class="subtitle">Silahkan masuk ke akun Anda</p>

                <!-- Gunakan route name agar lebih akurat -->
<form action="{{ route('login.proses') }}" method="POST">
    @csrf

    <!-- Tampilkan pesan error jika email/password salah -->
    @if($errors->any())
        <div style="color: red; margin-bottom: 10px; font-size: 0.8rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="input-group">
        <label>Email</label>
        <div class="input-wrapper">
            <i class="far fa-envelope"></i>
            <!-- PERBAIKAN: Tambahkan name="email" -->
            <input type="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
        </div>
    </div>

    <div class="input-group">
        <label>Password</label>
        <div class="input-wrapper">
            <!-- PERBAIKAN: Tambahkan name="password" -->
            <input type="password" name="password" placeholder="********" required>
            <i class="far fa-eye"></i>
        </div>
    </div>

    <button type="submit" class="btn-login">Masuk</button>
</form>

                <p class="footer-text">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
            </div>
        </div>
    </div>
</body>
</html>