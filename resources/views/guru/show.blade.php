@extends('layouts.admin')

@section('title', 'Detail Guru - SIAKAD SMA')
@section('page-title')
    Detail Data Guru: {{ $guru->user->name ?? 'Data User Hilang' }}
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
                <img src="{{ $guru->user->foto ? asset('storage/'.$guru->user->foto) : asset('img/undraw_profile.svg') }}"
                    alt="Foto {{ $guru->user->name }}"
                    class="img-thumbnail"
                    style="width: 100%; max-width: 250px; object-fit: cover;">
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 30%;"><strong>Nama Lengkap</strong></td>
                            <td>{{ $guru->user?->name ?? 'Data User Hilang' }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIP</strong></td>
                            <td>{{ $guru->nip }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $guru->user?->email ?? '-' }}</td>
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
                                @if(optional($guru->user)->status_aktif == 'Aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">{{ $guru->user?->status_aktif ?? 'Tidak Diketahui' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
