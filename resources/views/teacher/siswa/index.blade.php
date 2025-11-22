@extends('layouts.admin')
@section('title', 'Data Siswa Ajar')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa yang Anda Ajar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>L/P</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->jk }}</td>
                        <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <a href="{{ route('guru.nilai.index', ['siswa_id' => $siswa->id]) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-pen"></i> Nilai
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
