@extends('layouts.admin')

@section('title', 'Dashboard - SIAKAD SMA')
@section('page-title', 'Dashboard')

@section('content')

    @if(Auth::user()->role == 'admin')

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Guru Aktif
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataAdmin['guruAktif'] ?? '?' }}
                                </div>
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
                                    Siswa Aktif
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataAdmin['siswaAktif'] ?? '?' }}
                                </div>
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
                                    Kelas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataAdmin['kelas'] ?? '?' }}
                                </div>
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
                                    TA Semester Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataAdmin['ta'] ?? '?' }}
                                </div>
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
    <div class="col-12 mb-4">
        <a href="{{ route('jadwalPelajaran.index')}}" class="card bg-primary text-white shadow text-decoration-none">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="text-white-50 small">Aksi Cepat</div>
                <div class="text-lg font-weight-bold">
                    <i class="fas fa-calendar-alt mr-2"></i> Lihat Jadwal Pelajaran Lengkap
                </div>
                <i class="fas fa-arrow-right"></i>
            </div>
        </a>
    </div>
</div>


                </a>
            </div>
        </div>

    @elseif(Auth::user()->role == 'guru')

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Hari Ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataGuru['jamMengajar'] ?? '1 Jam' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
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
                                    Mengajar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataGuru['kelasMengajar'] ?? '1 Kelas' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
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
                                    Mapel Utama</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataGuru['mapelUtama'] ?? 'Matematika' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
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
                                    TA 2025/2026</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dataGuru['semester'] ?? 'Ganjil' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
