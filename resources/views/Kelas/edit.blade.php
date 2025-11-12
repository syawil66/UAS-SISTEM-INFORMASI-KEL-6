@extends('layouts.admin')

@section('title', 'Edit Kelas - SIAKAD SMA')
@section('page-title', 'Edit Data Kelas')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Data Kelas</h6>
    </div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Wali Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="wali_kelas" class="form-control" value="{{ old('wali_kelas', $kelas->wali_kelas) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jurusan <span class="text-danger">*</span></label>
                        <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $kelas->jurusan) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Siswa <span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_siswa" class="form-control" value="{{ old('jumlah_siswa', $kelas->jumlah_siswa) }}" required>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-right">
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
