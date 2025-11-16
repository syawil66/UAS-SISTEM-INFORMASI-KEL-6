@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah - SIAKAD SMA')
@section('page-title', 'Edit Profil Sekolah')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Profil Sekolah</h6>
    </div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profilSekolah.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $profil->alamat) }}">
                    </div>
                    <div class="form-group">
                        <label>Nama Kepala Sekolah</label>
                        <input type="text" name="nama_kepala_sekolah" class="form-control" value="{{ old('nama_kepala_sekolah', $profil->nama_kepala_sekolah) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenjang</label>
                        <input type="text" name="jenjang" class="form-control" value="{{ old('jenjang', $profil->jenjang) }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $profil->email) }}">
                    </div>
                </div>
            </div>
            <div class="mt-3 text-right">
                <a href="{{ route('profilSekolah.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
