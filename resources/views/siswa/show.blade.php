@extends('layouts.admin')

@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')

@section('content')

<div class="card shadow p-4">

    <div class="text-center mb-3">
        <img src="{{ $siswa->foto ? asset('uploads/siswa/'.$siswa->foto) : asset('default.png') }}"
             width="180" height="180"
             style="object-fit:cover; border-radius:10px;">
    </div>

    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $siswa->nama }}</td></tr>
        <tr><th>NIS</th><td>{{ $siswa->nis }}</td></tr>
        <tr><th>NISN</th><td>{{ $siswa->nisn }}</td></tr>
        <tr><th>Kelas</th><td>{{ $siswa->kelas }}</td></tr>
        <tr><th>Jurusan</th><td>{{ $siswa->jurusan }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $siswa->jk }}</td></tr>
        <tr><th>Email</th><td>{{ $siswa->email }}</td></tr>
        <tr><th>No HP</th><td>{{ $siswa->no_hp }}</td></tr>
        <tr><th>Status</th><td>{{ $siswa->status }}</td></tr>
    </table>

</div>

@endsection
