<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambah Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dokter-card {
            background: linear-gradient(to right, #cffafe, #ffffff);
            border-radius: 100px 20px 20px 100px;
            /* Ganti clip-path ke polygon untuk kompatibilitas */
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        }

        @media (min-width: 768px) {
            .dokter-card {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }
        }
    </style>
    <style>
        .parallelogram-right { transform: skewX(-15deg); display: inline-block; }
        .parallelogram-left { transform: skewX(15deg); display: inline-block; }
        .parallelogram-inner { transform: skewX(15deg); display: inline-block; }
        .parallelogram-inner-left { transform: skewX(-15deg); display: inline-block; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md min-h-screen px-6 py-8">
        <div class="mb-8 flex justify-center">
            <img src="/images/logo_transparant_klinik.png" alt="Logo Klinik" class="w-[160px]">
        </div>
        <nav class="space-y-4">
            <a href="#" onclick="showSection('default')" class="block text-gray-700 hover:text-cyan-500 font-medium">Dashboard</a>
            <a href="#" onclick="showSection('profil')" class="block text-gray-700 hover:text-cyan-500 font-medium">Profil</a>
            <a href="#" onclick="showSection('reservasi')" class="block text-gray-700 hover:text-cyan-500 font-medium">Reservasi</a>
            <a href="#" onclick="showSection('history')" class="block text-gray-700 hover:text-cyan-500 font-medium">History</a>
            <a href="#" onclick="showSection('dokter')" class="block text-gray-700 hover:text-cyan-500 font-medium">Dokter</a>
            <a href="{{ route('logout') }}" class="block text-red-500 hover:underline font-medium mt-4">Logout</a>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-10">
        <!-- Default Section -->
        <div id="default" class="space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-[#61C7C7]">Dashboard</h1>
                <input type="text" placeholder="Cari layanan atau dokter..." class="border border-gray-300 rounded px-4 py-2 w-64">
            </div>
            <div class="bg-gradient-to-r from-[#61C7C7] to-[#2EAFD8] text-white rounded-lg p-6 shadow-md mb-6">
                <h2 class="text-xl font-semibold">Selamat Datang, {{ session('user_nama') }}</h2>
                <p class="text-sm">Kami siap melayani kebutuhan kesehatan Anda</p>
            </div>
            <!-- Card Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded shadow">
                    <p class="text-gray-500">Total Kunjungan</p>
                    <p class="text-3xl font-bold">{{ $totalKunjungan }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <p class="text-gray-500">Reservasi Aktif</p>
                    <p class="text-3xl font-bold">{{ $reservasiAktif }}</p>
                </div>
            </div>
            <!-- Riwayat Terakhir -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Riwayat Reservasi Terakhir</h2>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="text-left bg-gray-100">
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Poli</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatTerakhir as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->waktu)->format('H:i') : '-' }}</td>
                            <td class="px-4 py-2 text-cyan-600">{{ $item->jadwal->poli ?? '-' }}</td>
                            <td class="px-4 py-2 text-green-600">Selesai</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right mt-2">
                    <a href="#" class="text-cyan-600 hover:underline">Selengkapnya →</a>
                </div>
            </div>
            <!-- Layanan Tersedia -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Layanan Tersedia</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($layanan as $l)
                    <div class="border rounded p-4">
                        <h3 class="font-semibold">Poli {{ ucfirst($l->poli) }}</h3>
                        <div class="text-sm text-gray-600 mb-1">
                            <strong>Waktu Layanan:</strong>
                            @php
                                $jadwalPoli = $jadwal->where('poli', $l->poli);
                                $waktus = $jadwalPoli->pluck('waktu')->unique();
                            @endphp
                            @if($waktus->count())
                                {{ $waktus->map(function($w) { return \Carbon\Carbon::parse($w)->format('H:i'); })->implode(', ') }}
                            @else
                                Tidak ada jadwal
                            @endif
                        </div>
                        <div class="text-sm text-gray-600">
                            <strong>Jumlah Pasien Hari Ini:</strong>
                            @php
                                $jumlahPasien = 0;
                                foreach($jadwalPoli as $jad) {
                                    $jumlahPasien += $jad->reservasi()
                                        ->whereDate('created_at', now()->toDateString())
                                        ->count();
                                }
                            @endphp
                            {{ $jumlahPasien }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section Profil -->
        <div id="profil" class="hidden text-gray-700 flex flex-col items-center justify-center min-h-[60vh] py-8">
            <div class="w-full max-w-5xl">
                <div class="bg-gradient-to-br from-cyan-100 via-white to-cyan-50 rounded-3xl shadow-2xl p-12 flex flex-col items-center border border-cyan-200">
                    <div class="relative flex flex-col items-center w-full">
                        <div class="w-32 h-32 rounded-full bg-cyan-200 flex items-center justify-center shadow-xl mb-6 border-4 border-white">
                            <i class="fa-solid fa-user text-7xl text-cyan-600"></i>
                        </div>
                        <h2 class="text-4xl font-extrabold text-cyan-700 mb-2 text-center drop-shadow">Profil Pengguna</h2>
                        <p class="text-gray-500 mb-8 text-center text-lg">Kelola informasi profil Anda</p>
                        <a href="#" class="absolute top-0 right-0 text-cyan-400 hover:text-cyan-600 transition-colors">
                            <i class="fas fa-pen text-xl"></i>
                        </a>
                    </div>
                    <div class="w-full mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex justify-between items-center border-b pb-4">
                                <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-id-card mr-3 text-cyan-400"></i>Nama Lengkap</span>
                                <span class="text-gray-800 font-semibold text-right">{{ session('user_nama') }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b pb-4">
                                <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-envelope mr-3 text-cyan-400"></i>Email</span>
                                <span class="text-gray-800 font-semibold text-right">{{ session('user_email') }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b pb-4">
                                <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-cake-candles mr-3 text-cyan-400"></i>Umur</span>
                                <span class="text-gray-800 font-semibold text-right">{{ session('user_umur') }} Tahun</span>
                            </div>
                            <div class="flex justify-between items-center border-b pb-4">
                                <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-venus-mars mr-3 text-cyan-400"></i>Jenis Kelamin</span>
                                <span class="text-gray-800 font-semibold text-right">
                                    {{ session('user_kelamin') === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center border-b pb-4">
                                <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-phone mr-3 text-cyan-400"></i>Nomor HP</span>
                                <span class="text-gray-800 font-semibold text-right">{{ session('user_nomor_hp') }}</span>
                            </div>
                            <div class="flex justify-between items-start md:col-span-2">
                                <span class="text-gray-500 font-medium flex items-center"><i class="fa-solid fa-location-dot mr-3 text-cyan-400"></i>Alamat</span>
                                <span class="text-gray-800 font-semibold text-right max-w-2xl">{{ session('user_alamat') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Reservasi -->
        <div id="reservasi" class="hidden text-gray-700">
            <section class="mt-10 bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Form Reservasi</h2>
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('reservasi.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" value="{{ session('user_nama') }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ session('user_email') }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Umur</label>
                        <input type="number" name="umur" value="{{ session('user_umur') }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kelamin</label>
                        <input type="text" name="kelamin" value="{{ session('user_kelamin') }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                        <input type="text" name="nomor_hp" value="{{ session('user_nomor_hp') }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ session('user_alamat') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Pilih Jadwal Dokter</label>
                        <select name="schedule_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach ($jadwal as $j)
                                <option value="{{ $j->schedule_id }}">
                                    {{ $j->nama }} ({{ $j->poli }}) - {{ $j->hari }} - {{ \Carbon\Carbon::parse($j->waktu)->format('H:i') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                        <textarea name="keluhan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>
                    <div class="md:col-span-2 text-right">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Kirim Reservasi
                        </button>
                    </div>
                </form>
            </section>
        </div>

        <!-- Section History -->
        <div id="history" class="hidden text-gray-700">
            <section class="mt-10 bg-white p-6 rounded shadow text-gray-700">
                <h2 class="text-xl font-bold mb-4">Riwayat Reservasi Anda</h2>
                @if ($history->isEmpty())
                    <p class="text-gray-500">Belum ada riwayat reservasi.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Dokter</th>
                                    <th class="border px-4 py-2 text-left">Poli</th>
                                    <th class="border px-4 py-2 text-left">Hari</th>
                                    <th class="border px-4 py-2 text-left">Waktu</th>
                                    <th class="border px-4 py-2 text-left">Keluhan</th>
                                    <th class="border px-4 py-2 text-left">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $item)
                                    <tr class="border-t">
                                        <td class="border px-4 py-2">{{ $item->jadwal->nama ?? '-' }}</td>
                                        <td class="border px-4 py-2">{{ $item->jadwal->poli ?? '-' }}</td>
                                        <td class="border px-4 py-2">{{ $item->jadwal->hari ?? '-' }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->waktu)->format('H:i') : '-' }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $item->keluhan }}</td>
                                        <td class="border px-4 py-2">{{ $item->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>

        <!-- Section Dokter -->
        <div id="dokter" class="hidden text-gray-700">
            <section class="bg-gray-100 py-12 px-6 md:px-12">
                <h2 class="text-xl md:text-2xl font-semibold text-cyan-600 mb-8">
                    <span class="text-cyan-500">Sipaling Serba Bisa</span>
                    <span class="text-teal-600">Memberi Dokter Yang Kamu Butuhkan</span>
                </h2>

                <div class="grid grid-cols-1 gap-8">
                    @php
                        $dokter = [
                            ['nama' => 'DR. Tohir Arsyad Romadhon', 'foto' => '/images/dokter/dokter-tohir.png', 'spesialis' => 'Dokter Umum'],
                            ['nama' => 'Dr. Izzati Al Fahwas', 'foto' => '/images/dokter/dokter-izzat.png', 'spesialis' => 'Dokter Anak'],
                            ['nama' => 'Dr. El Prans sakyono', 'foto' => '/images/dokter/dokter-prana.png', 'spesialis' => 'Dokter Kehamilan'],
                            ['nama' => 'Dr. Akhmad Akhnaf', 'foto' => '/images/dokter/dokter-ahnaf.png', 'spesialis' => 'Psikolog'],
                            ['nama' => 'Dr. Fahrel Djayantara', 'foto' => '/images/dokter/dokter-farel.png', 'spesialis' => 'Dokter Mata'],
                        ];
                        $days = ['SUN' => 'Minggu', 'MON' => 'Senin', 'TUE' => 'Selasa', 'WED' => 'Rabu', 'THU' => 'Kamis', 'FRI' => 'Jumat', 'SAT' => 'Sabtu'];
                    @endphp
                    @foreach ($dokter as $d)
                    <div class="dokter-card p-6 flex flex-col md:flex-row items-center gap-6 shadow-md relative bg-white rounded">
                        <div class="flex-shrink-0">
                            <div class="w-32 h-32 rounded-full border-8 border-cyan-400 overflow-hidden">
                                <img src="{{ $d['foto'] }}" alt="{{ $d['nama'] }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="parallelogram-left bg-cyan-600 mb-4">
                                <h3 class="text-xl md:text-2xl font-bold text-white px-4 py-1 parallelogram-inner-left">
                                    {{ $d['nama'] }}
                                </h3>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2 text-center">
                                @foreach ($days as $short => $full)
                                    @php
                                        $jadwal_hari = $jadwal->first(function($j) use ($d, $full) {
                                            return strtolower($j->nama) == strtolower($d['nama']) && strtolower($j->hari) == strtolower($full);
                                        });
                                    @endphp
                                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                                        <p class="font-semibold">{{ $short }}</p>
                                        @if ($jadwal_hari && $jadwal_hari->waktu)
                                            <p>{{ \Carbon\Carbon::parse($jadwal_hari->waktu)->format('H:i') }}</p>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <div class="parallelogram-right bg-cyan-600 text-white px-6 py-1 font-semibold text-sm md:text-base">
                                <div class="parallelogram-inner">
                                    {{ $d['spesialis'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>

    <script>
        function showSection(id) {
            const sections = ['default', 'profil', 'reservasi', 'history', 'dokter'];
            sections.forEach(section => {
                document.getElementById(section).classList.add('hidden');
            });
            document.getElementById(id).classList.remove('hidden');
        }
    </script>
</body>
</html>