<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Petugas')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            background: #f2f4f8;
            color: #e5eefb;
            font-family: "Inter", sans-serif;
        }

        .container {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background: #0f172a;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.05rem;
            color: #f8fafc;
        }

        .logo span {
            font-size: 0.95rem;
            letter-spacing: 0.02em;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 6px;
        }

        .menu li {
            border-radius: 14px;
            overflow: hidden;
        }

        .menu li.active,
        .menu li:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            color: #e5eefb;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .menu a i {
            width: 24px;
            text-align: center;
            font-size: 0.95rem;
        }

        .menu a:hover {
            color: #ffffff;
        }

        .main {
            background: #f5f7fb;
            padding: 0;
        }

        .page-content {
            padding: 24px 32px;
        }

        .header {
            background: white;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border-radius: 12px;
            border: 1px solid #d2d6dc;
            background: #f8fafc;
            color: #334155;
        }

        .user-profile i {
            color: #475569;
        }

        @media (max-width: 980px) {
            .container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                min-height: auto;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="container">

    <aside class="sidebar">
        <div class="logo">
            📖 <span>PERPUSTAKAAN DIGITAL</span>
        </div>

        <ul class="menu">
            <li class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <a href="{{ route('petugas.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
            </li>

            <li class="{{ request()->routeIs('petugas.books.*') ? 'active' : '' }}">
                <a href="{{ route('petugas.books.index') }}"><i class="fa fa-book"></i> Koleksi Buku</a>
            </li>

            <li class="{{ request()->routeIs('petugas.borrow.index') ? 'active' : '' }}">
                <a href="{{ route('petugas.borrow.index') }}"><i class="fa fa-box"></i> Peminjaman</a>
            </li>

            <li class="{{ request()->routeIs('petugas.returns.index') ? 'active' : '' }}">
                <a href="{{ route('petugas.returns.index') }}"><i class="fa fa-undo"></i> Pengembalian</a>
            </li>

            <li class="{{ request()->routeIs('petugas.members.index') ? 'active' : '' }}">
                <a href="{{ route('petugas.members.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
            </li>

            <li>
                <form action="{{ url('/logout') }}" method="GET">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer; width: 100%; text-align: left; padding: 0;">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <main class="main">
        <header class="header" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 25px; background: #fff; border-bottom: 1px solid #eee; margin-bottom: 20px;">
            <div class="search-bar" style="flex: 1; max-width: 400px; position: relative;">
                <i class="fa fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                <input type="text" placeholder="Cari buku..." style="width: 100%; padding: 10px 15px 10px 40px; border-radius: 5px; border: 1px solid #ddd; background: #f9f9f9;">
            </div>
            <div class="user-profile" style="display: flex; align-items: center; gap: 10px;">
                <i class="fa fa-user-circle" style="font-size: 30px; color: #333;"></i>
            </div>
        </header>

        <div class="page-content" style="padding: 0 25px;">
            @yield('content')
        </div>
    </main>

</div>

@stack('scripts')

</body>
</html>