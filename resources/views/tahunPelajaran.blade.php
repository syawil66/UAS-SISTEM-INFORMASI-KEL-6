@extends('layouts.admin')

@section('title', 'Tahun Pelajaran - SIAKAD SMA')
@section('page-title', 'Daftar Tahun Pelajaran')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Tahun Pelajaran
        </button>
    </div>
    <div class="card-body">

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
                <thead>
                    <tr>
                        <th>Tahun Pelajaran</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semuaTahunPelajaran as $tp)
                    <tr>
                        <td>{{ $tp->tahun_pelajaran }}</td>
                        <td>{{ $tp->semester }}</td>
                        <td>
                            @if($tp->status == 'Aktif')
                                <span class="badge badge-success">{{ $tp->status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $tp->status }}</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#editModal"
                                    data-id="{{ $tp->id }}"
                                    data-tahun="{{ $tp->tahun_pelajaran }}"
                                    data-semester="{{ $tp->semester }}"
                                    data-status="{{ $tp->status }}">
                                Edit
                            </button>

                            <form action="{{ route('tahunPelajaran.destroy', $tp->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
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

<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Tahun Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tahunPelajaran.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Pelajaran (cth: 2025/2026)</label>
                        <input type="text" name="tahun_pelajaran" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="status" class="form-check-input" value="Aktif" id="statusTambah">
                        <label class="form-check-label" for="statusTambah">Aktifkan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Tahun Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Pelajaran (cth: 2025/2026)</label>
                        <input type="text" id="edit_tahun_pelajaran" name="tahun_pelajaran" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select id="edit_semester" name="semester" class="form-control" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="edit_status" name="status" class="form-check-input" value="Aktif">
                        <label class="form-check-label" for="edit_status">Aktifkan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk mengisi data ke Modal Edit
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal

        // Ambil data dari atribut data-*
        var id = button.data('id');
        var tahun = button.data('tahun');
        var semester = button.data('semester');
        var status = button.data('status');

        var modal = $(this);

        // Buat URL action untuk form
        var actionUrl = "{{ url('tahun-pelajaran') }}/" + id;

        // Isi data ke dalam form
        modal.find('#editForm').attr('action', actionUrl);
        modal.find('#edit_tahun_pelajaran').val(tahun);
        modal.find('#edit_semester').val(semester);

        if (status == 'Aktif') {
            modal.find('#edit_status').prop('checked', true);
        } else {
            modal.find('#edit_status').prop('checked', false);
        }
    });
</script>
@endpush
