@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran - SIAKAD SMA')
@section('page-title', 'Tambah Data Mata Pelajaran Baru')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Data Mata Pelajaran</h6>
    </div>
    <div class="card-body">

        {{-- Validasi error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('akademik.matapelajaran.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    {{-- Kode Mapel --}}
                    <div class="form-group">
                        <label>Kode Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="kode_mapel" class="form-control"
                            value="{{ old('kode_mapel') }}" required>
                    </div>

                    {{-- Nama Mapel --}}
                    <div class="form-group">
                        <label>Nama Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="nama_mapel" class="form-control"
                            value="{{ old('nama_mapel') }}" required>
                    </div>

                    {{-- Kelompok --}}
                    <div class="form-group">
                        <label>Kelompok <span class="text-danger">*</span></label>
                        <select name="kelompok" class="form-control" required>
                            <option value="">-- Pilih Kelompok --</option>
                            <option value="Wajib" {{ old('kelompok') == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                            <option value="Peminatan" {{ old('kelompok') == 'Peminatan' ? 'selected' : '' }}>Peminatan</option>
                            <option value="Muatan Lokal" {{ old('kelompok') == 'Muatan Lokal' ? 'selected' : '' }}>Muatan Lokal</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    {{-- Kelas / Tingkat --}}
                    <div class="form-group">
                        <label>Kelas / Tingkat <span class="text-danger">*</span></label>
                        <input type="text" name="kelas_tingkat" class="form-control"
                            placeholder="Misal: X, XI, XII"
                            value="{{ old('kelas_tingkat') }}" required>
                    </div>

                    {{-- Semester --}}
                    <div class="form-group">
                        <label>Semester <span class="text-danger">*</span></label>
                        <select name="semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

                    {{-- Guru Pengampu (Relasi dari tabel Guru) --}}
                    <div class="form-group">
                        <label>Guru Pengampu</label>
                            <select name="guru_id" class="form-control" required>
                                <option value="">-- Pilih Guru --</option>
                                    @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}"
                                {{ (isset($mataPelajaran) && $mataPelajaran->guru_id == $guru->id) ? 'selected' : '' }}>
                                {{ $guru->user->name ?? 'Nama Error' }} - {{ $guru->bidang_ajar }}
                            </option>
                                @endforeach
                            </select>
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-right">
                <a href="{{ route('akademik.matapelajaran.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data Mata Pelajaran</button>
            </div>
        </form>
    </div>
</div>
@endsection
