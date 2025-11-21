@extends('layouts.admin')

@section('title', 'Profil Saya - SIAKAD SMA')
@section('page-title', 'Profil Saya')

@section('content')
<div class="row">

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <img class="img-profile rounded-circle mb-3"
                    src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('img/undraw_profile.svg') }}"
                    style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #eaecf4;">

                <h4 class="font-weight-bold text-dark">{{ $user->name }}</h4>
                <p class="text-muted mb-1">{{ $user->email }}</p>

                @if($user->role == 'admin')
                    <span class="badge badge-primary px-3 py-2">Administrator</span>
                @else
                    <span class="badge badge-success px-3 py-2">Guru Pengajar</span>
                @endif

                <hr>

                <div class="text-left">
                    <small class="text-muted">Status Akun</small>
                    <p class="font-weight-bold text-success"><i class="fas fa-check-circle"></i> {{ $user->status_aktif }}</p>

                    <small class="text-muted">Bergabung Sejak</small>
                    <p class="font-weight-bold">{{ $user->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Detail Informasi</h6>
                <a href="{{ route('profile.edit')}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit Profil</a>
            </div>
            <div class="card-body">

                @if($user->role == 'admin')
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Anda login sebagai <strong>Super Admin</strong>. Anda memiliki akses penuh ke seluruh sistem.
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="5%">:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email Login</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>

                @elseif($user->role == 'guru')

                    @if($user->guru)
                        <h5 class="heading-small text-muted mb-4">Informasi Akademik</h5>
                        <table class="table table-bordered mb-4">
                            <tr>
                                <td width="30%" class="bg-light"><strong>NIP</strong></td>
                                <td>{{ $user->guru->nip }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>Bidang Ajar</strong></td>
                                <td>{{ $user->guru->bidang_ajar }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>Status Kepegawaian</strong></td>
                                <td><span class="badge badge-info">{{ $user->guru->status_kepegawaian }}</span></td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>Tugas Tambahan</strong></td>
                                <td>
                                    @if($user->guru->is_wali_kelas)
                                        Wali Kelas
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <h5 class="heading-small text-muted mb-4">Informasi Pribadi</h5>
                        <table class="table table-bordered">
                            <tr>
                                <td width="30%" class="bg-light"><strong>No. Handphone</strong></td>
                                <td>{{ $user->guru->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>Alamat Lengkap</strong></td>
                                <td>{{ $user->guru->alamat_lengkap ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>Golongan</strong></td>
                                <td>{{ $user->guru->golongan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>NPWP</strong></td>
                                <td>{{ $user->guru->npwp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light"><strong>No. Rekening</strong></td>
                                <td>{{ $user->guru->no_rekening ?? '-' }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">
                            Data profil guru belum dilengkapi. Hubungi Admin.
                        </div>
                    @endif

                @endif

            </div>
        </div>
    </div>

</div>
@endsection
