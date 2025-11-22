@extends('layouts.admin')

@section('title', 'Atur Jadwal Pelajaran')
@section('page-title', 'Manajemen Jadwal Pelajaran')

@section('content')

{{-- 1. CARD FILTER KELAS --}}
<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <form action="{{ route('jadwalPelajaran.index') }}" method="GET" class="form-inline">
            <label class="mr-2 font-weight-bold text-gray-800">Pilih Kelas untuk Mengatur Jadwal:</label>
            <select name="kelas_id" class="form-control mr-2" onchange="this.form.submit()">
                <option value="">-- Pilih Kelas --</option>
                @foreach($dataKelas as $kls)
                    <option value="{{ $kls->id }}" {{ request('kelas_id') == $kls->id ? 'selected' : '' }}>
                        {{ $kls->nama_kelas }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
        </form>
    </div>
</div>

{{-- 2. TAMPILAN JADWAL (Hanya muncul jika kelas sudah dipilih) --}}
@if($kelasTerpilih)
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal Kelas: {{ $kelasTerpilih->nama_kelas }}</h6>

            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahJadwal">
                <i class="fas fa-plus"></i> Tambah Jadwal
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengajar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $j)
                        <tr>
                            <td class="font-weight-bold">{{ $j->hari }}</td>
                            <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                            <td>{{ $j->mapel->nama_mapel ?? '-' }}</td>
                            <td>{{ $j->guru->user->name ?? '-' }}</td>
                            <td>
                                <form action="{{ route('jadwalPelajaran.store') }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                                </form>

                                <form action="{{ route('jadwalPelajaran.destroy', $j->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                <img src="{{ asset('img/undraw_empty.svg') }}" width="100" class="mb-3"><br>
                                Belum ada jadwal untuk kelas ini. Silakan tambah jadwal.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahJadwal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Jadwal {{ $kelasTerpilih->nama_kelas }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwalPelajaran.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{-- Hidden Input ID Kelas --}}
                        <input type="hidden" name="kelas_id" value="{{ $kelasTerpilih->id }}">

                        <div class="form-group">
                            <label>Hari</label>
                            <select name="hari" class="form-control" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mapel_id" class="form-control" required>
                                <option value="">-- Pilih Mapel --</option>
                                @foreach($dataMapel as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Guru Pengajar</label>
                            <select name="guru_id" class="form-control" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach($dataGuru as $guru)
                                    <option value="{{ $guru->id }}">
                                        {{ $guru->user->name ?? 'No Name' }} ({{ $guru->bidang_ajar }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection
