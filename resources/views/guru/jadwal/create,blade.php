<form action="{{ route('jadwal.store') }}" method="POST">
    @csrf

    <label>Hari</label>
    <select name="hari">
        <option>Senin</option>
        <option>Selasa</option>
        <option>Rabu</option>
        <option>Kamis</option>
        <option>Jumat</option>
    </select>

    <label>Jam Mulai</label>
    <input type="time" name="jam_mulai">

    <label>Jam Selesai</label>
    <input type="time" name="jam_selesai">

    <label>Guru</label>
    <select name="guru_id">
        @foreach($gurus as $guru)
            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
        @endforeach
    </select>

    <label>Mata Pelajaran</label>
    <select name="mapel_id">
        @foreach($mapels as $mapel)
            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
        @endforeach
    </select>

    <label>Kelas</label>
    <select name="kelas_id">
        @foreach($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
        @endforeach
    </select>

    <button type="submit">Simpan</button>
</form>
