@extends('layouts.admin')

@section('content')
<h3>Rekap Nilai Siswa</h3>

<table class="table">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nilai as $n)
        <tr>
            <td>{{ $n->siswa->nama }}</td>
            <td>{{ $n->kelas }}</td>
            <td>{{ $n->mapel }}</td>
            <td>{{ $n->nilai }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
