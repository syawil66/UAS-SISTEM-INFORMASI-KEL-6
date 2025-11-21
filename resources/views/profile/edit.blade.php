@extends('layouts.admin')

@section('title', 'Edit Profil - SIAKAD SMA')
@section('page-title', 'Edit Profil Saya')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Profil</h6>
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

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h6 class="heading-small text-muted mb-4">Informasi Akun & Login</h6>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Foto Profil</label>
                        <div class="col-md-9">
                            <div class="mb-2">
                                <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('img/undraw_profile.svg') }}"
                                    class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <input type="file" name="foto" class="form-control-file">
                            <small class="text-muted">Format: JPG, PNG. Maks: 2MB.</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nama Lengkap</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Password Baru</label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-md-9">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
                        </div>
                    </div>

                    @if($user->role == 'guru')
                        <hr>
                        <h6 class="heading-small text-muted mb-4">Informasi Pribadi Guru</h6>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">NIP</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{ $user->guru->nip }}" disabled style="background-color: #eaecf4;">
                                <small class="text-muted">NIP tidak dapat diubah sendiri. Hubungi Admin.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">No. Handphone</label>
                            <div class="col-md-9">
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->guru->no_hp) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Alamat Lengkap</label>
                            <div class="col-md-9">
                                <textarea name="alamat_lengkap" class="form-control" rows="3">{{ old('alamat_lengkap', $user->guru->alamat_lengkap) }}</textarea>
                            </div>
                        </div>
                    @endif

                    <hr>
                    <div class="text-right">
                        <a href="{{ route('profile.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
