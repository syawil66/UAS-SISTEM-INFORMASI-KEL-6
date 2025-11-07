@extends('layouts.admin')

@section('title', 'Tambah Guru - SIAKAD SMA')
@section('page-title', 'Tambah Data Guru Baru')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Data Guru</h6>
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

        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap Guru <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" class="form-control" value="{{ old('nama_guru') }}" required>
                    </div>

                    <div class="form-group">
                        <label>NIP (Nomor Induk Pegawai) <span class="text-danger">*</span></label>
                        <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required
                            data-toggle="tooltip" data-placement="top" title="Harus unik.">
                        @error('nip') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                            data-toggle="tooltip" data-placement="top" title="Harus unik dan format email valid.">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>No. Handphone</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                    </div>

                    <div class="form-group">
                        <label>Mata Pelajaran / Bidang Ajar <span class="text-danger">*</span></label>
                        <input type="text" name="bidang_ajar" class="form-control" value="{{ old('bidang_ajar') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control">{{ old('alamat_lengkap') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Foto (Opsional)</label>
                        <input type="file" name="foto" class="form-control">
                        <small class="form-text text-muted">Maksimal 2MB (jpeg, png, jpg)</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status Kepegawaian <span class="text-danger">*</span></label>
                        <select name="status_kepegawaian" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach($dropdownData['status_kepegawaian'] as $status)
                                <option value="{{ $status }}" {{ old('status_kepegawaian') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Golongan (Opsional)</label>
                        <select name="golongan" class="form-control">
                            <option value="">-- Pilih Golongan --</option>
                            @foreach($dropdownData['golongan'] as $gol)
                                <option value="{{ $gol }}" {{ old('golongan') == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Aktif <span class="text-danger">*</span></label>
                        <select name="status_aktif" class="form-control" required>
                            @foreach($dropdownData['status_aktif'] as $status)
                                <option value="{{ $status }}" {{ old('status_aktif') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check my-3">
                        <input type="checkbox" name="is_wali_kelas" class="form-check-input" id="is_wali_kelas" value="1" {{ old('is_wali_kelas') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_wali_kelas">Jadikan sebagai Wali Kelas?</label>
                    </div>

                    <hr>
                    <p>Informasi Sensitif (Hanya bisa dilihat Admin)</p>

                    <div class="form-group">
                        <label>NPWP</label>
                        <input type="text" name="npwp" class="form-control" value="{{ old('npwp') }}">
                    </div>

                    <div class="form-group">
                        <label>No. Rekening</label>
                        <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening') }}">
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-right">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data Guru</button>
            </div>
        </form>
    </div>
</div>
@endsection
