@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h3>JADWAL MENGAJAR</h3>

    <table class="table table-bordered mt-3">
        <thead class="table-primary">
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $j)
                <tr>
                    <td>{{ $j->hari }}</td>
                    <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                    <td>{{ $j->mapel->nama_mapel }}</td>
                    <td>{{ $j->kelas->nama_kelas }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada jadwal</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
