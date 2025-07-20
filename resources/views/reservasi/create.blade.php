<!DOCTYPE html>
<html>
<head>
    <title>Form Reservasi</title>
</head>
<body>
    <h1>Form Reservasi Klinik</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/reservasi">
        @csrf

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Umur:</label><br>
        <input type="number" name="umur" required><br><br>

        <label>Kelamin:</label><br>
        <select name="kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="nomor_hp" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <label>Pilih Jadwal Dokter:</label><br>
        <select name="schedule_id" required>
            @foreach($jadwal as $j)
                <option value="{{ $j->schedule_id }}">
                    Dokter {{ $j->nama }}, Poli {{ $j->poli }}, {{ $j->hari }}, {{ $j->waktu }}
                </option>
            @endforeach
        </select><br><br>

        <label>Keluhan:</label><br>
        <textarea name="keluhan" required></textarea><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
