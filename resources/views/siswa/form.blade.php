<div class="row">

    <div class="col-md-4">
        <label>Foto Siswa</label><br>
        <input type="file" name="foto" class="form-control mb-2">

        @if(isset($siswa) && $siswa->foto)
            <img src="{{ asset('uploads/siswa/'.$siswa->foto) }}"
                 width="120" class="rounded shadow">
        @endif
    </div>

    <div class="col-md-8">

        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $siswa->nama ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>NIS</label>
            <input type="text" name="nis" value="{{ old('nis', $siswa->nis ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>NISN</label>
            <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Kelas</label>
            <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Jurusan</label>
            <input type="text" name="jurusan" value="{{ old('jurusan', $siswa->jurusan ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Jenis Kelamin</label>
            <select name="jk" class="form-control">
                <option value="L" {{ old('jk', $siswa->jk ?? '')=='L'?'selected':'' }}>Laki-laki</option>
                <option value="P" {{ old('jk', $siswa->jk ?? '')=='P'?'selected':'' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $siswa->email ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Aktif" {{ old('status', $siswa->status ?? '')=='Aktif'?'selected':'' }}>Aktif</option>
                <option value="Tidak Aktif" {{ old('status', $siswa->status ?? '')=='Tidak Aktif'?'selected':'' }}>Tidak Aktif</option>
            </select>
        </div>

        <button class="btn btn-success mt-3">Simpan</button>

    </div>

</div>
