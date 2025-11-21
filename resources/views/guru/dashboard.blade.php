@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Dashboard Guru</h3>

    {{-- Informasi Guru --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Selamat datang, {{ Auth::user()->name }}</h5>
            <p class="card-text text-muted">Role: Guru</p>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">{{ $jumlahKelas ?? 0 }}</h4>
                    <p class="card-text">Jumlah Kelas</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">{{ $jumlahMurid ?? 0 }}</h4>
                    <p class="card-text">Jumlah Murid</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">{{ $jadwalHariIni->count() ?? 0 }}</h4>
                    <p class="card-text">Jadwal Hari Ini</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Jadwal Hari Ini --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Jadwal Mengajar Hari Ini</h5>
        </div>
        <div class="card-body">
            @if(isset($jadwalHariIni) && $jadwalHariIni->count() > 0)
                <ul class="list-group">
                    @foreach($jadwalHariIni as $jadwal)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $jadwal->mapel }} - Kelas {{ $jadwal->kelas }}</span>
                            <span>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Tidak ada jadwal hari ini.</p>
            @endif
        </div>
    </div>

    {{-- Quick Menu --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Menu Cepat</h5>
        </div>
        <div class="card-body">
    <a href="{{ route('guru.siswa.index') }}" class="btn btn-outline-primary me-2 mb-2">
        Data Siswa
    </a>

    <a href="{{ route('guru.nilai.index') }}" class="btn btn-outline-success me-2 mb-2">
        Input Nilai
    </a>

    <a href="#" class="btn btn-outline-info mb-2 disabled">
        Rekap Nilai (Hanya Admin)
    </a>
</div>

    </div>

</div>
@endsection
