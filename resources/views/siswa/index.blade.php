@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page-title', 'Daftar Siswa')

@section('content')

<!-- Tombol Tambah Siswa (mirip tombol guru) -->
<a href="{{ route('siswa.create') }}"
   class="btn btn-primary mb-3"
   style="background-color:#4e73df; border-color:#4e73df; font-weight:500;">
    <i class="fas fa-plus"></i> Tambahkan Siswa
</a>

<div class="card shadow">
    <div class="card-body">

        <!-- Scroll horizontal jika tabel panjang -->
        <div style="overflow-x:auto;">

            <table class="table table-bordered table-striped table-hover" style="min-width: 1200px;">
                <thead class="table-primary">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>JK</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($siswas as $s)
                    <tr>
                        <td>
                            <img src="{{ $s->foto ? asset('uploads/siswa/'.$s->foto) : asset('default.png') }}"
                                 width="55" height="55"
                                 style="object-fit:cover; border-radius:8px;">
                        </td>

                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->nisn }}</td>
                        <td>{{ $s->kelas }}</td>
                        <td>{{ $s->jurusan }}</td>
                        <td>{{ $s->jk }}</td>
                        <td>{{ $s->email }}</td>
                        <td>{{ $s->no_hp }}</td>

                        <td>
                            <span class="badge bg-success text-white">{{ $s->status }}</span>
                        </td>

                        <td>
                            <a href="{{ route('siswa.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('siswa.show', $s->id) }}" class="btn btn-info btn-sm">View</a>

                            <form method="POST" class="d-inline"
                                  action="{{ route('siswa.destroy', $s->id) }}">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus data ini?')"
                                        class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection
