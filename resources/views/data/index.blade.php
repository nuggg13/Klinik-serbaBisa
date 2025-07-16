<!DOCTYPE html>
<html>
<head>
    <title>Daftar Data Pasien</title>
</head>
<body>
    <h1>Daftar Data Pasien</h1>

    <a href="{{ route('data.create') }}">+ Tambah Data Baru</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Kelamin</th>
                <th>Nomor Hp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
                <tr>
                    <td>{{ $d->nomor }}</td>
                    <td>{{ $d->email }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->umur }}</td>
                    <td>{{ $d->kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $d->nomor_hp }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td><a href="{{ route('data.edit', $d->nomor) }}">Edit</a>
                        <form action="{{ route('data.destroy', $d->nomor) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
