@extends('layouts.admin')

@section('title', 'Profil Sekolah - SIAKAD SMA')
@section('page-title', 'Profil Sekolah')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Profil Sekolah</h6>

        @if(Auth::user()->role == 'admin')
            <a href="{{ route('profilSekolah.edit') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
        @endif
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <input type="text" class="form-control" value="{{ $profil->nama_sekolah ?? 'Belum diatur' }}" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" value="{{ $profil->alamat ?? 'Belum diatur' }}" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Kepala Sekolah</label>
                    <input type="text" class="form-control" value="{{ $profil->nama_kepala_sekolah ?? 'Belum diatur' }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenjang</label>
                    <input type="text" class="form-control" value="{{ $profil->jenjang ?? 'Belum diatur' }}" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $profil->email ?? 'Belum diatur' }}" readonly>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
