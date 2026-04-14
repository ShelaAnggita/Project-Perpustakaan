@extends('layouts.app')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard Petugas')
@section('page_description', 'Ringkasan aktivitas dan statistik petugas perpustakaan.')

@section('content')
<div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Dashboard Petugas</h2>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <div style="color: #888; font-size: 14px; margin-bottom: 10px;">Permintaan Pinjam</div>
        <h3 style="margin: 0; font-size: 32px; color: #4a90e2;">{{ $stats['pendingBorrow'] }}</h3>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <div style="color: #888; font-size: 14px; margin-bottom: 10px;">Permintaan Kembali</div>
        <h3 style="margin: 0; font-size: 32px; color: #e2a64a;">{{ $stats['pendingReturn'] }}</h3>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <div style="color: #888; font-size: 14px; margin-bottom: 10px;">Total Buku</div>
        <h3 style="margin: 0; font-size: 32px; color: #4ae24a;">{{ $stats['totalBooks'] }}</h3>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <div style="color: #888; font-size: 14px; margin-bottom: 10px;">Total Anggota</div>
        <h3 style="margin: 0; font-size: 32px; color: #e24a4a;">{{ $stats['totalMembers'] }}</h3>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
        <div style="color: #888; font-size: 14px; margin-bottom: 10px;">Total Kategori</div>
        <h3 style="margin: 0; font-size: 32px; color: #a64ae2;">{{ $stats['totalCategories'] }}</h3>
    </div>
</div>
@endsection
