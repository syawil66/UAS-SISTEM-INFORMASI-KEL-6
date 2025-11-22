@extends('layouts.admin')

@section('content')
<h3>Rekap Nilai Siswa</h3>

<table class="table">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Nilai Tugas</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nilai as $n)
        <tr>
            <td>{{ $n->siswa->nama }}</td>
            <td>{{ $n->kelas->nama_kelas ?? '-' }}</td>
            <td>{{ $n->mapel->nama_mapel ?? '-' }}</td>

            <td>{{ $n->nilai_tugas }}</td>
            <td>{{ $n->nilai_uts }}</td>
            <td>{{ $n->nilai_uas }}</td>

            <td>{{ round(($n->nilai_tugas + $n->nilai_uts + $n->nilai_uas) / 3, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
