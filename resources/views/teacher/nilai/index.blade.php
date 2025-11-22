@extends('layouts.admin')
@section('title', 'Input Nilai Siswa')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <form action="{{ route('guru.nilai.index') }}" method="GET" class="form-inline">
                    <label class="mr-2 font-weight-bold text-gray-800">Pilih Kelas yang Anda Ajar:</label>
                    <select name="kelas_id" class="form-control mr-2">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($listKelas as $jadwal)
                        <option value="{{ $jadwal->kelas_id }}" {{ request('kelas_id') == $jadwal->kelas_id ? 'selected' : '' }}>
                            {{ $jadwal->kelas->nama_kelas }} - {{ $jadwal->mataPelajaran->nama_mapel }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Tampilkan Siswa</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(request('kelas_id') && $siswas)
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Input Nilai Kelas: {{ $selectedKelas->nama_kelas }}</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('guru.nilai.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-gray-200">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Siswa</th>
                            <th width="15%">Nilai Tugas</th>
                            <th width="15%">Nilai UTS</th>
                            <th width="15%">Nilai UAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $siswa->nama }}
                                <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                            </td>
                            <td>
                                <input type="number" name="nilai_tugas[{{ $siswa->id }}]" class="form-control" min="0" max="100" placeholder="0">
                            </td>
                            <td>
                                <input type="number" name="nilai_uts[{{ $siswa->id }}]" class="form-control" min="0" max="100" placeholder="0">
                            </td>
                            <td>
                                <input type="number" name="nilai_uas[{{ $siswa->id }}]" class="form-control" min="0" max="100" placeholder="0">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-3">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-save"></i> Simpan Semua Nilai
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
