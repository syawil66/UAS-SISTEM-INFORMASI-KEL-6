@extends('layouts.admin')

@section('title', 'Profil Sekolah - SIAKAD SMA')
@section('page-title', 'Profil Sekolah')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Profil Sekolah</h6>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" class="form-control" value="{{ $profil->nama_sekolah ?? '' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" value="{{ $profil->alamat ?? '' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Kepala Sekolah</label>
                        <input type="text" class="form-control" value="{{ $profil->nama_kepala_sekolah ?? '' }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenjang</label>
                        <input type="text" class="form-control" value="{{ $profil->jenjang ?? '' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" value="{{ $profil->email ?? '' }}" readonly>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="button" class="btn btn-primary">Edit Profil</button>
            </div>
        </form>
    </div>
</div>
@endsection
