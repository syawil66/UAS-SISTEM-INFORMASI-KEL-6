@extends('layouts.admin')

@section('title', 'Tambah Data Kelas')
@section('page-title', 'Tambah Data Kelas')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kelas</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_kelas">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas"
                    class="form-control @error('nama_kelas') is-invalid @enderror"
                    placeholder="Contoh: XII IPA 1" required>
                @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan"
                    class="form-control @error('jurusan') is-invalid @enderror"
                    placeholder="Contoh: IPA, IPS, Bahasa" required>
                @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="wali_kelas">Wali Kelas</label>
                <input type="text" name="wali_kelas" id="wali_kelas"
                    class="form-control @error('wali_kelas') is-invalid @enderror"
                    placeholder="Nama wali kelas" required>
                @error('wali_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_siswa">Jumlah Siswa</label>
                <input type="number" name="jumlah_siswa" id="jumlah_siswa"
                    class="form-control @error('jumlah_siswa') is-invalid @enderror"
                    placeholder="Jumlah siswa dalam kelas" required>
                @error('jumlah_siswa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
