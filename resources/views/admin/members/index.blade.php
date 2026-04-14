@extends('layouts.app')

@section('title', 'Data Anggota')
@section('page_title', 'Data Anggota')
@section('page_description', 'Lihat anggota yang terdaftar beserta jumlah peminjamannya.')

@section('content')
<div class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Total Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $member->nama_lengkap }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->peminjaman_count }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">Belum ada anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
