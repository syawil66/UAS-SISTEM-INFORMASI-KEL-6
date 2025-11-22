@extends('layouts.admin')
@section('title', 'Jadwal Mengajar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal Mengajar Anda</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td class="font-weight-bold">{{ $jadwal->hari }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                        </td>
                        <td>{{ $jadwal->mataPelajaran->nama_mapel ?? '-' }}</td>
                        <td><span class="badge badge-primary">{{ $jadwal->kelas->nama_kelas ?? '-' }}</span></td>
                        <td>
                            @if(now()->isoFormat('dddd') == $jadwal->hari)
                                <span class="badge badge-success">Hari Ini</span>
                            @else
                                <span class="badge badge-secondary">Jadwal Lain</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
