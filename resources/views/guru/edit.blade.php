@extends('layouts.admin')

@section('title', 'Edit Guru - SIAKAD SMA')
@section('page-title', 'Edit Data Guru')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data Guru</h6>
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

        <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap Guru <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $guru->user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>NIP (Nomor Induk Pegawai) <span class="text-danger">*</span></label>
                        <input type="text" name="nip" class="form-control" value="{{ old('nip', $guru->nip) }}" required
                            data-toggle="tooltip" data-placement="top" title="Harus unik.">
                        @error('nip') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $guru->user->email) }}" required
                            data-toggle="tooltip" data-placement="top" title="Harus unik dan format email valid.">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Ganti Password (Opsional)</label>
                        <input type="password" name="password" class="form-control"
                            data-toggle="tooltip" data-placement="top" title="Kosongkan jika tidak ingin ganti password.">
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>No. Handphone</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $guru->no_hp) }}">
                    </div>

                    <div class="form-group">
                        <label>Mata Pelajaran / Bidang Ajar <span class="text-danger">*</span></label>
                        <input type="text" name="bidang_ajar" class="form-control" value="{{ old('bidang_ajar', $guru->bidang_ajar) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control">{{ old('alamat_lengkap', $guru->alamat_lengkap) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Foto Baru (Opsional)</label>
                        <input type="file" name="foto" class="form-control">
                        <small class="form-text text-muted">Maksimal 2MB (jpeg, png, jpg). Kosongkan jika tidak ingin ganti foto.</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status Kepegawaian <span class="text-danger">*</span></label>
                        <select name="status_kepegawaian" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach($dropdownData['status_kepegawaian'] as $status)
                                <option value="{{ $status }}" {{ old('status_kepegawaian', $guru->status_kepegawaian) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Golongan</label>
                        <select name="golongan" class="form-control">
                            <option value="">-- Pilih Golongan --</option>
                            @foreach($dropdownData['golongan'] as $gol)
                                <option value="{{ $gol }}" {{ old('golongan', $guru->golongan) == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label>Status Aktif <span class="text-danger">*</span></label>
                        <select name="status_aktif" class="form-control" required>
                            @foreach($dropdownData['status_aktif'] as $status)
                                <option value="{{ $status }}" {{ old('status_aktif', $guru->user->status_aktif) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check my-3">
                        <input type="checkbox" name="is_wali_kelas" class="form-check-input" id="is_wali_kelas" value="1" {{ old('is_wali_kelas', $guru->is_wali_kelas) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_wali_kelas">Jadikan sebagai Wali Kelas?</label>
                    </div>

                    <hr>
                    <p>Informasi Sensitif (Hanya bisa dilihat Admin)</p>

                    <div class="form-group">
                        <label>NPWP</label>
                        <input type="text" name="npwp" class="form-control" value="{{ old('npwp', $guru->npwp) }}">
                    </div>

                    <div class="form-group">
                        <label>No. Rekening</label>
                        <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening', $guru->no_rekening) }}">
                    </div>
                </div>
            </div>

            <hr>
            <div class="text-right">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data Guru</button>
            </div>
        </form>
    </div>
</div>
@endsection
