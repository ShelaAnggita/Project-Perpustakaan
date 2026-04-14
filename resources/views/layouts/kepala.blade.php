<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Kepala Perpustakaan')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg: #f5f7fb;
            --panel: #ffffff;
            --line: #d8deea;
            --text: #1f2937;
            --muted: #6b7280;
            --brand: #0f766e;
            --brand-soft: #ccfbf1;
            --danger: #dc2626;
            --warning: #d97706;
        }
        * { box-sizing: border-box; }
        html, body { min-height: 100%; margin: 0; }
        body { font-family: "Segoe UI", sans-serif; background: var(--bg); color: var(--text); }
        a { color: inherit; text-decoration: none; }
        .shell { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }
        .sidebar { background: #0f172a; color: #e5eefb; padding: 24px 18px; position: sticky; top: 0; align-self: start; height: 100vh; overflow-y: auto; }
        .brand { font-size: 22px; font-weight: 700; margin-bottom: 24px; }
        .brand small { display: block; font-size: 12px; color: #94a3b8; margin-top: 6px; }
        .menu { display: grid; gap: 8px; }
        .menu a, .menu button { border: 0; width: 100%; text-align: left; background: transparent; color: inherit; padding: 12px 14px; border-radius: 12px; font-size: 14px; cursor: pointer; }
        .menu a.active, .menu a:hover, .menu button:hover { background: rgba(255,255,255,0.08); }
        .main { padding: 24px; overflow-y: auto; min-height: 100vh; }
        .topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; position: sticky; top: 0; z-index: 2; background: inherit; padding: 0 0 20px; }
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 20px; }
        .card, .panel { background: var(--panel); border: 1px solid var(--line); border-radius: 18px; padding: 18px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); }
        .card h3, .panel h3 { margin-top: 0; }
        .muted { color: var(--muted); }
        .badge { display: inline-flex; align-items: center; border-radius: 999px; padding: 5px 10px; font-size: 12px; font-weight: 600; }
        .badge.info { background: #dbeafe; color: #1d4ed8; }
        .badge.success { background: #dcfce7; color: #15803d; }
        .badge.warn { background: #fef3c7; color: #b45309; }
        .badge.danger { background: #fee2e2; color: #b91c1c; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid var(--line); vertical-align: top; text-align: left; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 14px; border-radius: 12px; border: 0; cursor: pointer; font-weight: 600; }
        .btn-primary { background: var(--brand); color: white; }
        .btn-secondary { background: #e2e8f0; color: #0f172a; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-warning { background: var(--warning); color: white; }
        .btn:disabled { opacity: .55; cursor: not-allowed; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .books { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 16px; }
        .book-card { background: var(--panel); border: 1px solid var(--line); border-radius: 18px; overflow: hidden; }
        .book-cover { width: 100%; height: 250px; object-fit: cover; background: #e5e7eb; }
        .book-body { padding: 16px; display: grid; gap: 12px; }
        input, select, textarea { width: 100%; padding: 11px 12px; border-radius: 12px; border: 1px solid var(--line); font: inherit; background: white; }
        textarea { min-height: 120px; resize: vertical; }
        .field { display: grid; gap: 8px; margin-bottom: 14px; }
        .alert { margin-bottom: 16px; padding: 14px; border-radius: 14px; }
        .alert.success { background: #dcfce7; color: #166534; }
        .alert.error { background: #fee2e2; color: #991b1b; }
        .actions { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
        .pagination-actions { display: inline-flex; gap: 6px; margin-left: auto; align-items: center; }
        .pagination-label { font-size: 0.85rem; color: var(--text); padding: 0 6px; }
        .btn-icon { min-width: 32px; width: 32px; height: 32px; padding: 0; font-size: 1rem; border-radius: 10px; }
        .btn-icon:hover { background: #e2e8f0; }
        .password-wrapper { position: relative; }
        .password-wrapper input { padding-right: 16px; }
        .password-hint { margin-top: 8px; font-size: 0.92rem; color: var(--text); }
        .password-hint label { display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
        .password-hint input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--brand); }
        .panel--spaced { margin-bottom: 20px; }
        .pagination-panel { margin-top: 16px; padding: 6px 10px; border-radius: 12px; border: 1px solid var(--line); background: var(--panel); display: flex; justify-content: center; }
        .pagination { display: flex; flex-wrap: wrap; gap: 3px; list-style: none; padding: 0; margin: 0; justify-content: center; }
        .pagination li { display: inline-flex; }
        .pagination li a, .pagination li span { display: inline-flex; align-items: center; justify-content: center; min-width: 24px; height: 24px; padding: 0 6px; border-radius: 6px; border: 1px solid var(--line); background: white; color: var(--text); text-decoration: none; font-size: 0.75rem; font-weight: 500; transition: all 0.2s ease; }
        .pagination li a:hover { background: #f8fafc; border-color: var(--brand); transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .pagination li.active span { background: var(--brand); color: white; border-color: var(--brand); transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.2s ease; }
        .pagination li.disabled span { opacity: .5; cursor: not-allowed; transition: all 0.2s ease; }
        @media (max-width: 900px) {
            .shell { grid-template-columns: 1fr; }
            .sidebar { padding-bottom: 10px; position: relative; height: auto; }
            .grid-2 { grid-template-columns: 1fr; }
        }
        @media print {
            .sidebar, .topbar, .menu, .actions { display: none !important; }
            body, .shell, .main { background: white; width: 100%; }
            .panel { border: none; box-shadow: none; }
        }
    </style>
</head>
<body>
@php
    $user = auth()->user();
    $role = $user?->role;
@endphp
<div class="shell">
    <aside class="sidebar">
        <div class="brand">
            Perpustakaan Digital
            <small>{{ $user?->nama_lengkap }} - {{ ucfirst(str_replace('_', ' ', $role ?? 'guest')) }}</small>
        </div>

        <nav class="menu">
            <a href="{{ route('kepala.dashboard') }}" class="{{ request()->routeIs('kepala.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('kepala.books.index') }}" class="{{ request()->routeIs('kepala.books.*') ? 'active' : '' }}">Koleksi Buku</a>
            <a href="{{ route('kepala.categories.index') }}" class="{{ request()->routeIs('kepala.categories.*') ? 'active' : '' }}">Kategori</a>
            <a href="{{ route('kepala.borrow.index') }}" class="{{ request()->routeIs('kepala.borrow.*') ? 'active' : '' }}">Peminjaman</a>
            <a href="{{ route('kepala.returns.index') }}" class="{{ request()->routeIs('kepala.returns.*') ? 'active' : '' }}">Pengembalian</a>
            <a href="{{ route('kepala.members.index') }}" class="{{ request()->routeIs('kepala.members.*') ? 'active' : '' }}">Data Anggota</a>
            <a href="{{ route('kepala.staff.index') }}" class="{{ request()->routeIs('kepala.staff.*') ? 'active' : '' }}">Tambah Petugas</a>
            <a href="{{ route('kepala.reports.index') }}" class="{{ request()->routeIs('kepala.reports.*') ? 'active' : '' }}">Laporan</a>

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1 style="margin:0;">@yield('page_title', 'Dashboard')</h1>
                <p class="muted" style="margin:6px 0 0;">@yield('page_description', 'Kelola perpustakaan digital dengan mudah.')</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')

</body>
</html>