@extends('layouts.admin')

@section('title', 'Data Kelas - SIAKAD SMA')
@section('page-title', 'Daftar Kelas')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Akademik - Daftar Kelas</h6>
        <div>
            <a href="{{ route('akademik.matapelajaran.index') }}" class="btn btn-warning btn-sm mr-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Mata Pelajaran
            </a>
            <a href="{{ route('akademik.kelas.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kelas
            </a>
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Wali Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Jurusan</th>
                        <th>Jumlah Siswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelas as $item)
                        <tr>
                            <td>{{ $item->wali_kelas }}</td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>{{ $item->jumlah_siswa }}</td>
                            <td class="text-center">
                                <a href="{{ route('akademik.kelas.edit', $item->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('akademik.kelas.destroy', $item->id) }}" method="POST" class="d-inline">
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
                            <td colspan="5" class="text-center">Belum ada data kelas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
