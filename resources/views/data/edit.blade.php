<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data Pasien</h1>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data.update', $data->nomor) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email', $data->email) }}"><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="{{ old('nama', $data->nama) }}"><br><br>

        <label>Umur:</label><br>
        <input type="number" name="umur" value="{{ old('umur', $data->umur) }}"><br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $data->nomor_hp) }}"><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat">{{ old('alamat', $data->alamat) }}</textarea><br><br>


        <label>Kelamin:</label><br>
        <select name="kelamin">
            <option value="L" {{ old('kelamin', $data->kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('kelamin', $data->kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
