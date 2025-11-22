@extends('layouts.admin')

@section('title', 'Data Guru - SIAKAD SMA')
@section('page-title', 'Data Guru') {{-- --}}

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{route('guru.create')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambahkan Guru
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('guru.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <label>Cari (Nama, NIP, Bidang Ajar)</label>
                    <input type="text" name="search" class="form-control"
                        value="{{ $searchTerm ?? '' }}" placeholder="Masukkan kata kunci...">
                </div>
                <div class="col-md-4">
                    <label>Status Aktif</label>
                    <select name="status_aktif" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="Aktif" {{ ($statusAktif ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ ($statusAktif ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </div>
        </form>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Guru</th> {{-- --}}
                        <th>NIP</th> {{-- --}}
                        <th>Email</th> {{-- --}}
                        <th>Status</th> {{-- --}}
                        <th>Wali Kelas?</th>
                        <th>Aksi</th> {{-- --}}
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data guru dari controller --}}
                    @forelse($gurus as $guru)
                    <tr>
                        <td>
                            <img src="{{ $guru->user->foto ? asset('storage/'.$guru->user->foto) : asset('img/undraw_profile.svg') }}"
                                alt="Foto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        </td>
                        <td>{{ $guru->user->name }}</td>
                        <td>{{ $guru->nip }}</td>
                        <td>{{ $guru->user->email }}</td>
                        <td>{{ $guru->status_kepegawaian }}</td>
                        <td>
                            @if($guru->is_wali_kelas)
                                <span class="badge badge-success">Ya</span>
                            @else
                                <span class="badge badge-secondary">Bukan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('guru.show', $guru->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{route('guru.edit', $guru->id)}}" class="btn btn-warning btn-sm">Edit</a> {{-- --}}
                            <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data guru masih kosong.</td>
                    </tr>
                    @endforelse

                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
