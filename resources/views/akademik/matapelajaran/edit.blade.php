@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran - SIAKAD SMA')
@section('page-title', 'Edit Data Mata Pelajaran')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Mata Pelajaran</h6>
    </div>

    <div class="card-body">
        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('akademik.matapelajaran.update', $mataPelajaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="kode_mapel" class="form-control"
                            value="{{ old('kode_mapel', $mataPelajaran->kode_mapel) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="nama_mapel" class="form-control"
                            value="{{ old('nama_mapel', $mataPelajaran->nama_mapel) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Kelompok <span class="text-danger">*</span></label>
                        <select name="kelompok" class="form-control" required>
                            <option value="">-- Pilih Kelompok --</option>
                            <option value="Umum" {{ old('kelompok', $mataPelajaran->kelompok) == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="Peminatan" {{ old('kelompok', $mataPelajaran->kelompok) == 'Peminatan' ? 'selected' : '' }}>Peminatan</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kelas / Tingkat <span class="text-danger">*</span></label>
                        <input type="text" name="kelas_tingkat" class="form-control"
                            value="{{ old('kelas_tingkat', $mataPelajaran->kelas_tingkat) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Semester <span class="text-danger">*</span></label>
                        <select name="semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil" {{ old('semester', $mataPelajaran->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester', $mataPelajaran->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                    </div>

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
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
