@extends('layouts.admin')

@section('title', 'Dashboard - SIAKAD SMA')
@section('page-title', 'Dashboard')

@section('content')


    {{--@if(auth()->check() && auth()->user()->role == 'admin')--}}

        {{-- INI KONTEN UNTUK ADMIN (sesuai DASHBOARD.pdf) --}}

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    [cite_start]Guru Aktif [cite: 14]</div>
                                [cite_start]<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataAdmin['guruAktif'] }} [cite: 13]</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    [cite_start]Siswa Aktif [cite: 15]</div>
                                [cite_start]<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataAdmin['siswaAktif'] }} [cite: 15]</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    [cite_start]Kelas [cite: 16]</div>
                                [cite_start]<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataAdmin['kelas'] }} [cite: 16]</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    TA Semester Ini</div>
                                [cite_start]<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataAdmin['ta'] }} [cite: 17]</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <a href="#" class="btn btn-primary btn-icon-split btn-lg w-100">
                    <span class="icon text-white-50"><i class="fas fa-calendar-alt"></i></span>
                    [cite_start]<span class="text">Lihat Jadwal Pelajaran [cite: 19]</span>
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="#" class="btn btn-info btn-icon-split btn-lg w-100">
                    <span class="icon text-white-50"><i class="fas fa-file-alt"></i></span>
                    [cite_start]<span class="text">Rekap Nilai [cite: 20]</span>
                </a>
            </div>
        </div>

    {{--@else
        {{-- Tampilkan dashboard untuk Guru, dll
        <h1>Halo, Guru!</h1>
    @endif--}}

@endsection
