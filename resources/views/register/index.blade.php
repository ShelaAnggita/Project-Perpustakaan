<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Anggota</title>
    <style>
        body { margin: 0; font-family: "Segoe UI", sans-serif; min-height: 100vh; display: grid; place-items: center; background: #e2e8f0; }
        .card { width: min(520px, calc(100% - 32px)); background: white; padding: 28px; border-radius: 24px; }
        input { width: 100%; box-sizing: border-box; padding: 12px; border-radius: 12px; border: 1px solid #cbd5e1; margin-top: 8px; margin-bottom: 14px; }
        .password-wrapper { position: relative; }
        .password-wrapper input { padding-right: 16px; }
        .password-hint { margin-top: 10px; font-size: 0.92rem; color: #334155; }
        .password-hint label { display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
        .password-hint input[type="checkbox"] { width: 16px; height: 16px; accent-color: #0f766e; }
        button { width: 100%; padding: 12px; border: 0; border-radius: 12px; background: #0f766e; color: white; font-weight: 700; cursor: pointer; }
        .alert { background: #fee2e2; color: #991b1b; border-radius: 12px; padding: 12px; margin-bottom: 14px; }
    </style>
</head>
<body>
    <form class="card" action="{{ route('register.store') }}" method="POST">
        @csrf
        <h1 style="margin-top:0;">Registrasi Anggota</h1>
        <p style="color:#64748b;">Akun anggota bisa dibuat mandiri. Akun petugas dibuat kepala perpustakaan.</p>

        @if($errors->any())
            <div class="alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <div class="password-wrapper">
            <input id="register-password" type="password" name="password" required>
        </div>
        <div class="password-hint">
            <label><input class="toggle-password-checkbox" type="checkbox" data-target="register-password"> Tampilkan sandi</label>
        </div>

        <label>Konfirmasi Password</label>
        <div class="password-wrapper">
            <input id="register-password-confirm" type="password" name="password_confirmation" required>
        </div>
        <div class="password-hint">
            <label><input class="toggle-password-checkbox" type="checkbox" data-target="register-password-confirm"> Tampilkan sandi</label>
        </div>

        <button type="submit">Daftar</button>

        <p style="margin-bottom:0; margin-top:14px;">Sudah punya akun? <a href="{{ route('login') }}">Kembali ke login</a></p>
    </form>
    <script>
        document.addEventListener('change', function(event) {
            if (!event.target.closest('.toggle-password-checkbox')) return;
            const checkbox = event.target.closest('.toggle-password-checkbox');
            const input = document.getElementById(checkbox.dataset.target);
            if (!input) return;
            input.type = checkbox.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
