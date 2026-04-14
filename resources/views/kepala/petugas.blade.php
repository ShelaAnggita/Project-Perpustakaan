@extends('layouts.app')

@section('title', 'Kelola Petugas')
@section('page_title', 'Tambah Petugas')
@section('page_description', 'Kepala perpustakaan membuat akun petugas baru.')

@section('content')
<div class="grid-2">
    <div class="panel">
        <h3>Form Petugas Baru</h3>
        <form action="{{ route('kepala.staff.store') }}" method="POST">
            @csrf
            <div class="field">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="field">
                <label>Password</label>
                <div class="password-wrapper">
                    <input id="staff-password" type="password" name="password" required>
                </div>
                <div class="password-hint">
                    <label><input class="toggle-password-checkbox" type="checkbox" data-target="staff-password"> Tampilkan sandi</label>
                </div>
            </div>
            <div class="field">
                <label>Konfirmasi Password</label>
                <div class="password-wrapper">
                    <input id="staff-password-confirm" type="password" name="password_confirmation" required>
                </div>
                <div class="password-hint">
                    <label><input class="toggle-password-checkbox" type="checkbox" data-target="staff-password-confirm"> Tampilkan sandi</label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Buat Akun Petugas</button>
        </form>
    </div>
    <div class="panel">
        <h3>Daftar Petugas</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff as $item)
                        <tr>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->email }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="muted">Belum ada petugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
