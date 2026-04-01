<aside class="sidebar">
    <div class="logo">
        📖 <span>PERPUSTAKAAN DIGITAL</span>
    </div>

    <ul class="menu">
        <li>
            <a href="{{ route('dashboard-anggota') }}">
                <i class="fa fa-home"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('koleksi-buku') }}">
                <i class="fa fa-book"></i> Koleksi Buku
            </a>
        </li>

        <li>
            <a href="/peminjaman">
                <i class="fa fa-user"></i> Peminjaman Saya
            </a>
        </li>

        <li>
            <a href="/pengembalian">
                <i class="fa fa-undo"></i> Pengembalian
            </a>
        </li>

        <li>
            <a href="/riwayat">
                <i class="fa fa-history"></i> Riwayat Peminjaman
            </a>
        </li>

        <li>
            <a href="/logout">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</aside>