@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Input Nilai Siswa</h3>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('guru.nilai.store') }}" method="POST">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Nilai</th>
                </tr>
            </thead>

            <tbody>
                @foreach($siswas as $siswa)
                <tr>
                    <td>{{ $siswa->nama }}</td>

                    {{-- siswa_id dikirim pakai array --}}
                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                    <td>
                        <input type="text" name="mapel" class="form-control" placeholder="Contoh: Matematika">
                    </td>

                    <td>
                        <input type="text" name="kelas" class="form-control" placeholder="Contoh: X IPA 1">
                    </td>

                    <td>
                        <input type="number" name="nilai" class="form-control">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </form>
</div>
@endsection
