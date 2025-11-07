@extends('layouts.admin')

@section('title', 'Detail Guru - SIAKAD SMA')
@section('page-title')
    Detail Data Guru: {{ $guru->nama_guru }}
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('guru.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
        <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit Data Ini
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ $guru->foto ? asset('storage/'.$guru->foto) : asset('img/undraw_profile.svg') }}"
                    alt="Foto {{ $guru->nama_guru }}"
                    class="img-thumbnail"
                    style="width: 100%; max-width: 250px; object-fit: cover;">
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 30%;"><strong>Nama Lengkap</strong></td>
                            <td>{{ $guru->nama_guru }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIP</strong></td>
                            <td>{{ $guru->nip }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $guru->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. Handphone</strong></td>
                            <td>{{ $guru->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status Kepegawaian</strong></td>
                            <td><span class="badge badge-info">{{ $guru->status_kepegawaian }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Golongan</strong></td>
                            <td>{{ $guru->golongan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Mata Pelajaran / Bidang Ajar</strong></td>
                            <td>{{ $guru->bidang_ajar }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status Aktif</strong></td>
                            <td>
                                @if($guru->status_aktif == 'Aktif')
                                    <span class="badge badge-success">{{ $guru->status_aktif }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $guru->status_aktif }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Wali Kelas?</strong></td>
                            <td>
                                @if($guru->is_wali_kelas)
                                    <span class="badge badge-success">Ya</span>
                                @else
                                    <span class="badge badge-secondary">Bukan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Lengkap</strong></td>
                            <td>{{ $guru->alamat_lengkap ?? '-' }}</td>
                        </tr>

                        <tr class="table-warning">
                            <td colspan="2"><strong>Informasi Sensitif</strong></td>
                        </tr>
                        <tr>
                            <td><strong>NPWP</strong></td>
                            <td>{{ $guru->npwp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. Rekening</strong></td>
                            <td>{{ $guru->no_rekening ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
