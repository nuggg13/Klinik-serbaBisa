<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>
    <h1>Form Tambah Data Pasien</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

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

    {{-- Form --}}
    <form action="{{ route('data.store') }}" method="POST">
        @csrf

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="{{ old('nama') }}"><br><br>

        <label>Umur:</label><br>
        <input type="number" name="umur" value="{{ old('umur') }}"><br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}"><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat">{{ old('alamat') }}</textarea><br><br>

        <label>Kelamin:</label><br>
        <select name="kelamin">
            <option value="">-- Pilih Kelamin --</option>
            <option value="L" {{ old('kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
