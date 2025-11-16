@extends('layouts.admin')

@section('title', 'Data Mata Pelajaran - SIAKAD SMA')
@section('page-title', 'Data Mata Pelajaran')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('akademik.kelas.index')}}" class="btn btn-primary">
            <i class="fas fa-arrow-right"></i> Lihat Data Kelas
        </a>
        <a href="{{ route('akademik.matapelajaran.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambahkan Mata Pelajaran
        </a>
    </div>

    <div class="card-body">
        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Form Pencarian --}}
        <form action="{{ route('akademik.matapelajaran.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <label>Cari (Kode atau Nama Mapel)</label>
                    <input type="text" name="search" class="form-control"
                        value="{{ $searchTerm ?? '' }}" placeholder="Masukkan kata kunci...">
                </div>
                <div class="col-md-4">
                    <label>Kelompok</label>
                    <select name="kelompok" class="form-control">
                        <option value="">-- Semua Kelompok --</option>
                        <option value="Umum" {{ ($kelompok ?? '') == 'Umum' ? 'selected' : '' }}>Umum</option>
                        <option value="Peminatan" {{ ($kelompok ?? '') == 'Peminatan' ? 'selected' : '' }}>Peminatan</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('akademik.matapelajaran.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Kode Mapel</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Kelompok</th>
                        <th>Kelas/Tingkat</th>
                        <th>Semester</th>
                        <th>Guru Pengampu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mataPelajaran as $mapel)
                    <tr>
                        <td>{{ $mapel->kode_mapel }}</td>
                        <td>{{ $mapel->nama_mapel }}</td>
                        <td>{{ $mapel->kelompok }}</td>
                        <td>{{ $mapel->kelas_tingkat }}</td>
                        <td>{{ $mapel->semester }}</td>
                        <td>{{ $mapel->guru_pengampu }}</td>
                        <td>
                            <a href="{{ route('akademik.matapelajaran.edit', $mapel->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('akademik.matapelajaran.destroy', $mapel->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data mata pelajaran masih kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
