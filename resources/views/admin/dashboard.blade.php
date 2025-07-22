<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md min-h-screen px-6 py-8">
        <div class="mb-8 flex justify-center">
            <img src="/images/logo_transparant_klinik.png" alt="Logo Klinik" class="w-40 object-contain">
        </div>

        <nav class="space-y-4">
            <a href="#" onclick="showSection('beranda')" class="block text-gray-700 hover:text-cyan-500 font-medium">Beranda</a>
            <a href="#" onclick="showSection('akun-pasien')" class="block text-gray-700 hover:text-cyan-500 font-medium">Akun Pasien</a>
            <a href="#" onclick="showSection('reservasi')" class="block text-gray-700 hover:text-cyan-500 font-medium">Reservasi Pasien</a>
            <a href="#" onclick="showSection('jadwal')" class="block text-gray-700 hover:text-cyan-500 font-medium">Jadwal Dokter</a>
            <a href="#" onclick="showSection('laporan')" class="block text-gray-700 hover:text-cyan-500 font-medium">Laporan</a>
            <a href="#" onclick="showSection('riwayat')" class="block text-gray-700 hover:text-cyan-500 font-medium">Riwayat Pasien</a>
            <a href="#" onclick="showSection('akun-admin')" class="block text-gray-700 hover:text-cyan-500 font-medium">Akun Admin</a>
            <a href="{{ route('logout') }}" class="block text-red-500 hover:underline font-medium mt-4">Logout</a>
        </nav>
    </aside>

    {{-- Konten Utama --}}
    <main class="flex-1 p-10 text-gray-700">

        {{-- Beranda --}}
        <div id="beranda" class="section">
            <h1 class="text-2xl font-bold mb-4">Selamat Datang Admin!</h1>
            <p class="text-gray-600">Gunakan menu di sebelah kiri untuk mengelola sistem klinik.</p>
        </div>

        {{-- Akun Pasien --}}
        <div id="akun-pasien" class="section hidden">
            <h2 class="text-xl font-bold mb-4">Kelola Akun Pasien</h2>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Pasien</h3>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Total: {{ count($dataPasien) }} pasien</span>
                        <button onclick="showAddForm()" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            + Tambah Pasien
                        </button>
                    </div>
                </div>

                @if($dataPasien->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Umur</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Kelamin</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">No. HP</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Alamat</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataPasien as $pasien)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm">{{ $pasien->email }}</td>
                                        <td class="px-4 py-3 text-sm font-medium">{{ $pasien->nama }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pasien->umur }} tahun</td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $pasien->kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                {{ $pasien->kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $pasien->nomor_hp }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $pasien->alamat }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="flex space-x-2">
                                                <button onclick="showEditForm({{ $pasien->nomor }})" class="text-cyan-600 hover:text-cyan-800 text-xs">Edit</button>
                                                <button onclick="confirmDelete({{ $pasien->nomor }}, '{{ $pasien->nama }}')" 
                                                    class="text-red-600 hover:text-red-800 text-xs">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data pasien</h3>
                            <p class="mt-1 text-sm text-gray-500">Belum ada pasien yang terdaftar dalam sistem.</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Form Tambah Pasien --}}
            <div id="form-tambah-pasien" class="bg-white rounded-lg shadow-md p-6 mt-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Tambah Pasien Baru</h3>
                    <button onclick="hideAddForm()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.pasien.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Umur --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                            <input type="number" name="umur" value="{{ old('umur') }}" min="1" max="120" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            @error('umur')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kelamin</label>
                            <select name="kelamin" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                                <option value="">Pilih Kelamin</option>
                                <option value="L" {{ old('kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor HP --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="tel" name="nomor_hp" value="{{ old('nomor_hp') }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="08123456789">
                            @error('nomor_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Masukkan alamat lengkap...">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="hideAddForm()" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" 
                            class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                            Simpan Pasien
                        </button>
                    </div>
                </form>
            </div>

            {{-- Form Edit Pasien --}}
            <div id="form-edit-pasien" class="bg-white rounded-lg shadow-md p-6 mt-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Edit Data Pasien</h3>
                    <button onclick="hideEditForm()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="form-update-pasien" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="edit-email" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" id="edit-nama" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        {{-- Umur --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                            <input type="number" name="umur" id="edit-umur" min="1" max="120" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        {{-- Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kelamin</label>
                            <select name="kelamin" id="edit-kelamin" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                                <option value="">Pilih Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        {{-- Nomor HP --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="tel" name="nomor_hp" id="edit-nomor_hp" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="edit-password"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" id="edit-alamat" rows="3" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"></textarea>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="hideEditForm()" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" 
                            class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                            Update Pasien
                        </button>
                    </div>
                </form>
            </div>

            {{-- Modal Konfirmasi Hapus --}}
            <div id="modal-hapus" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Hapus</h3>
                                <p class="text-sm text-gray-500 mb-4">
                                    Apakah Anda yakin ingin menghapus data pasien <span id="nama-pasien" class="font-semibold"></span>? 
                                    <br>Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <button onclick="hideDeleteModal()" 
                                    class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 transition duration-200">
                                    Batal
                                </button>
                                <form id="form-hapus" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-200">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Placeholder Sections --}}
        <div id="reservasi" class="section hidden"><h2 class="text-xl font-bold mb-4">Data Reservasi Pasien</h2></div>

        {{-- Jadwal Dokter --}}
<div id="jadwal" class="section hidden">
    <h2 class="text-xl font-bold mb-4">Kelola Jadwal Dokter</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar Jadwal Dokter</h3>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Total: {{ count($dataJadwal) }} jadwal</span>
                <button onclick="showAddJadwalForm()" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    + Tambah Jadwal
                </button>
            </div>
        </div>

        @if($dataJadwal->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama Dokter</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Poli</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Hari</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Waktu</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Max Reservasi</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataJadwal as $jadwal)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium">{{ $jadwal->nama }}</td>
                                <td class="px-4 py-3 text-sm">{{ $jadwal->poli }}</td>
                                <td class="px-4 py-3 text-sm">{{ $jadwal->hari }}</td>
                                <td class="px-4 py-3 text-sm">{{ $jadwal->waktu }}</td>
                                <td class="px-4 py-3 text-sm text-center">{{ $jadwal->maximal_reservasi }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button onclick="showEditJadwalForm({{ $jadwal->schedule_id }})" class="text-cyan-600 hover:text-cyan-800 text-xs">Edit</button>
                                        <button onclick="confirmDeleteJadwal({{ $jadwal->schedule_id }}, '{{ $jadwal->nama }}')" 
                                            class="text-red-600 hover:text-red-800 text-xs">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada jadwal dokter</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada jadwal dokter yang terdaftar.</p>
                </div>
            </div>
        @endif
    </div>

    {{-- Form Tambah Jadwal --}}
    <div id="form-tambah-jadwal" class="bg-white rounded-lg shadow-md p-6 mt-6 hidden">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Tambah Jadwal Dokter</h3>
            <button onclick="hideAddJadwalForm()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        @if(session('success_jadwal'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success_jadwal') }}
            </div>
        @endif

        @if(session('error_jadwal'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error_jadwal') }}
            </div>
        @endif

        <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dokter</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poli</label>
                    <select name="poli" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="">Pilih Poli</option>
                        <option value="Umum">Poli Umum</option>
                        <option value="Gigi">Poli Gigi</option>
                        <option value="KIA">Poli KIA</option>
                        <option value="Anak">Poli Anak</option>
                        <option value="Mata">Poli Mata</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                    <select name="hari" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                    <input type="text" name="waktu" value="{{ old('waktu') }}" required
                        placeholder="08:00 - 12:00"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Maksimal Reservasi</label>
                    <input type="number" name="maximal_reservasi" value="{{ old('maximal_reservasi') }}" min="1" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="hideAddJadwalForm()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>

    {{-- Form Edit Jadwal --}}
    <div id="form-edit-jadwal" class="bg-white rounded-lg shadow-md p-6 mt-6 hidden">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Edit Jadwal Dokter</h3>
            <button onclick="hideEditJadwalForm()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="form-update-jadwal" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dokter</label>
                    <input type="text" name="nama" id="edit-nama-dokter" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poli</label>
                    <select name="poli" id="edit-poli" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="">Pilih Poli</option>
                        <option value="Umum">Poli Umum</option>
                        <option value="Gigi">Poli Gigi</option>
                        <option value="KIA">Poli KIA</option>
                        <option value="Anak">Poli Anak</option>
                        <option value="Mata">Poli Mata</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                    <select name="hari" id="edit-hari" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                    <input type="text" name="waktu" id="edit-waktu" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Maksimal Reservasi</label>
                    <input type="number" name="maximal_reservasi" id="edit-maximal-reservasi" min="1" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="hideEditJadwalForm()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                    Update Jadwal
                </button>
            </div>
        </form>
    </div>

    {{-- Modal Konfirmasi Hapus Jadwal --}}
    <div id="modal-hapus-jadwal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Hapus</h3>
                        <p class="text-sm text-gray-500 mb-4">
                            Apakah Anda yakin ingin menghapus jadwal Dr. <span id="nama-dokter-hapus" class="font-semibold"></span>? 
                            <br>Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button onclick="hideDeleteJadwalModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 transition duration-200">
                            Batal
                        </button>
                        <form id="form-hapus-jadwal" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-200">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div id="laporan" class="section hidden"><h2 class="text-xl font-bold mb-4">Laporan & Statistik</h2></div>
        <div id="riwayat" class="section hidden"><h2 class="text-xl font-bold mb-4">Riwayat Pasien</h2></div>


        {{-- Akun Admin --}}
<div id="akun-admin" class="section hidden">
    <h2 class="text-xl font-bold mb-4">Kelola Akun Admin</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar Admin</h3>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Total: {{ count($dataAdmin) }} admin</span>
                <button onclick="showAddAdminForm()" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    + Tambah Admin
                </button>
            </div>
        </div>

        @if($dataAdmin->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama Admin</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataAdmin as $admin)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium">{{ $admin->nama_admin }}</td>
                                <td class="px-4 py-3 text-sm">{{ $admin->email }}</td>
                                
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2">
                                        <button onclick="showEditAdminForm({{ $admin->nomor }})" class="text-cyan-600 hover:text-cyan-800 text-xs">Edit</button>
                                        <button onclick="confirmDeleteAdmin({{ $admin->nomor }}, '{{ $admin->nama_admin }}')" 
                                            class="text-red-600 hover:text-red-800 text-xs">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data admin</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada admin yang terdaftar dalam sistem.</p>
                </div>
            </div>
        @endif
    </div>

    {{-- Form Tambah Admin --}}
    <div id="form-tambah-admin" class="bg-white rounded-lg shadow-md p-6 mt-6 hidden">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Tambah Admin Baru</h3>
            <button onclick="hideAddAdminForm()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        @if(session('success_admin'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success_admin') }}
            </div>
        @endif

        @if(session('error_admin'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error_admin') }}
            </div>
        @endif

        <form action="{{ route('admin.admin.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nama Admin --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                    <input type="text" name="nama_admin" value="{{ old('nama_admin') }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('nama_admin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="hideAddAdminForm()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>

    {{-- Form Edit Admin --}}
    <div id="form-edit-admin" class="bg-white rounded-lg shadow-md p-6 mt-6 hidden">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Edit Data Admin</h3>
            <button onclick="hideEditAdminForm()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="form-update-admin" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nama Admin --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                    <input type="text" name="nama_admin" id="edit-nama_admin" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="edit-email-admin" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" id="edit-password-admin"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="edit-password-confirmation-admin"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        placeholder="Kosongkan jika tidak mengubah password">
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="hideEditAdminForm()" 
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                    Update Admin
                </button>
            </div>
        </form>
    </div>

    {{-- Modal Konfirmasi Hapus Admin --}}
    <div id="modal-hapus-admin" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Hapus</h3>
                        <p class="text-sm text-gray-500 mb-4">
                            Apakah Anda yakin ingin menghapus admin <span id="nama-admin-hapus" class="font-semibold"></span>? 
                            <br>Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button onclick="hideDeleteAdminModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 transition duration-200">
                            Batal
                        </button>
                        <form id="form-hapus-admin" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition duration-200">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </main>

    <script>
        function showSection(id) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(s => s.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
        }

        function showAddForm() {
            document.getElementById('form-tambah-pasien').classList.remove('hidden');
        }

        function hideAddForm() {
            document.getElementById('form-tambah-pasien').classList.add('hidden');
        }

        function confirmDelete(id, nama) {
            document.getElementById('nama-pasien').textContent = nama;
            document.getElementById('form-hapus').action = `/admin/pasien/${id}`;
            document.getElementById('modal-hapus').classList.remove('hidden');
        }

        function hideDeleteModal() {
            document.getElementById('modal-hapus').classList.add('hidden');
        }

        // Tutup modal jika klik di luar modal
        document.getElementById('modal-hapus').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });

        function showEditForm(id) {
            console.log('Edit button clicked for ID:', id); // Debug log
            
            // Fetch data pasien via AJAX
            fetch(`/admin/pasien/${id}/edit`)
                .then(response => {
                    console.log('Response received:', response); // Debug log
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data); // Debug log
                    
                    if (data.success) {
                        // Isi form dengan data pasien
                        document.getElementById('edit-email').value = data.data.email;
                        document.getElementById('edit-nama').value = data.data.nama;
                        document.getElementById('edit-umur').value = data.data.umur;
                        document.getElementById('edit-kelamin').value = data.data.kelamin;
                        document.getElementById('edit-nomor_hp').value = data.data.nomor_hp;
                        document.getElementById('edit-alamat').value = data.data.alamat;
                        
                        // Set form action
                        document.getElementById('form-update-pasien').action = `/admin/pasien/${id}`;
                        
                        // Tampilkan form edit
                        document.getElementById('form-edit-pasien').classList.remove('hidden');
                        
                        // Scroll ke form
                        document.getElementById('form-edit-pasien').scrollIntoView({ 
                            behavior: 'smooth' 
                        });
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data pasien: ' + error.message);
                });
        }

        function hideEditForm() {
            document.getElementById('form-edit-pasien').classList.add('hidden');
            // Reset form
            document.getElementById('form-update-pasien').reset();
        }
    </script>

    <script>
// Fungsi untuk Admin CRUD
function showAddAdminForm() {
    document.getElementById('form-tambah-admin').classList.remove('hidden');
}

function hideAddAdminForm() {
    document.getElementById('form-tambah-admin').classList.add('hidden');
}

function confirmDeleteAdmin(id, nama) {
    document.getElementById('nama-admin-hapus').textContent = nama;
    document.getElementById('form-hapus-admin').action = `/admin/admin/${id}`;
    document.getElementById('modal-hapus-admin').classList.remove('hidden');
}

function hideDeleteAdminModal() {
    document.getElementById('modal-hapus-admin').classList.add('hidden');
}

// Tutup modal jika klik di luar modal
document.getElementById('modal-hapus-admin').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDeleteAdminModal();
    }
});

function showEditAdminForm(id) {
    console.log('Edit admin button clicked for ID:', id);
    
    // Fetch data admin via AJAX
    fetch(`/admin/admin/${id}/edit`)
        .then(response => {
            console.log('Response received:', response);
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            
            if (data.success) {
                // Isi form dengan data admin
                document.getElementById('edit-nama_admin').value = data.data.nama_admin;
                document.getElementById('edit-email-admin').value = data.data.email;
                
                // Set form action
                document.getElementById('form-update-admin').action = `/admin/admin/${id}`;
                
                // Tampilkan form edit
                document.getElementById('form-edit-admin').classList.remove('hidden');
                
                // Scroll ke form
                document.getElementById('form-edit-admin').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data admin: ' + error.message);
        });
}

function hideEditAdminForm() {
    document.getElementById('form-edit-admin').classList.add('hidden');
    // Reset form
    document.getElementById('form-update-admin').reset();
}
</script>

<script>
// Fungsi untuk Jadwal Dokter CRUD
function showAddJadwalForm() {
    document.getElementById('form-tambah-jadwal').classList.remove('hidden');
}

function hideAddJadwalForm() {
    document.getElementById('form-tambah-jadwal').classList.add('hidden');
}

function confirmDeleteJadwal(id, nama) {
    document.getElementById('nama-dokter-hapus').textContent = nama;
    document.getElementById('form-hapus-jadwal').action = `/admin/jadwal/${id}`;
    document.getElementById('modal-hapus-jadwal').classList.remove('hidden');
}

function hideDeleteJadwalModal() {
    document.getElementById('modal-hapus-jadwal').classList.add('hidden');
}

document.getElementById('modal-hapus-jadwal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDeleteJadwalModal();
    }
});

function showEditJadwalForm(id) {
    fetch(`/admin/jadwal/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('edit-nama-dokter').value = data.data.nama;
                document.getElementById('edit-poli').value = data.data.poli;
                document.getElementById('edit-hari').value = data.data.hari;
                document.getElementById('edit-waktu').value = data.data.waktu;
                document.getElementById('edit-maximal-reservasi').value = data.data.maximal_reservasi;
                
                document.getElementById('form-update-jadwal').action = `/admin/jadwal/${id}`;
                document.getElementById('form-edit-jadwal').classList.remove('hidden');
                
                document.getElementById('form-edit-jadwal').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data jadwal');
        });
}

function hideEditJadwalForm() {
    document.getElementById('form-edit-jadwal').classList.add('hidden');
    document.getElementById('form-update-jadwal').reset();
}
</script>

</body>
</html>