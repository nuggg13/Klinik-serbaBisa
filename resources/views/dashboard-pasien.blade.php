<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <style>
        .dokter-card {
            background: linear-gradient(to right, #cffafe, #ffffff);
            border-radius: 100px 20px 20px 100px;
            clip-path: path("M0,0 
                Q60,0 100,64 
                Q60,128 0,128 
                L100%,128 
                L100%,0 
                Z");
        }

        @media (min-width: 768px) {
            .dokter-card {
                clip-path: path("M0,0 
                    Q100,0 160,160 
                    Q100,320 0,320 
                    L100%,320 
                    L100%,0 
                    Z");
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md min-h-screen px-6 py-8">
        <div class="mb-8 flex justify-center">
            <img src="/images/logo_transparant_klinik.png" alt="Logo Klinik" class="w-50 object-contain">
        </div>

        <nav class="space-y-4">
            <a href="#" onclick="showSection('profil')" class="block text-gray-700 hover:text-cyan-500 font-medium">Profil</a>
            <a href="#" onclick="showSection('reservasi')" class="block text-gray-700 hover:text-cyan-500 font-medium">Reservasi</a>
            <a href="#" onclick="showSection('history')" class="block text-gray-700 hover:text-cyan-500 font-medium">History</a>
            <a href="#" onclick="showSection('dokter')" class="block text-gray-700 hover:text-cyan-500 font-medium">Dokter</a>
            <a href="{{ route('logout') }}" class="block text-red-500 hover:underline font-medium mt-4">Logout</a>
        </nav>
    </aside>

    {{-- Konten Utama --}}
    <main class="flex-1 p-10">

        {{-- Default Section --}}
        <div id="default" class="text-gray-700">
            <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ session('user_nama') }}!</h1>
            <p class="text-gray-600">Silakan pilih menu di sebelah kiri untuk mengelola data Anda.</p>
        </div>

        {{-- Section Profil --}}
        <div id="profil" class="hidden text-gray-700 space-y-4">
            <h2 class="text-xl font-bold mb-4">Profil Pasien</h2>
            <div><strong>Email:</strong> {{ session('user_email') }}</div>
            <div><strong>Nama:</strong> {{ session('user_nama') }}</div>
            <div><strong>Umur:</strong> {{ session('user_umur') }}</div>
            <div><strong>Jenis Kelamin:</strong>
                {{ session('user_kelamin') === 'L' ? 'Laki-laki' : 'Perempuan' }}
            </div>
            <div><strong>Nomor HP:</strong> {{ session('user_nomor_hp') }}</div>
            <div><strong>Alamat:</strong> {{ session('user_alamat') }}</div>
        </div>

        {{-- Section Reservasi --}}
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

        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ session('user_nama') }}" readonly
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ session('user_email') }}" readonly
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Umur -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Umur</label>
            <input type="number" name="umur" value="{{ session('user_umur') }}" readonly
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Kelamin -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Kelamin</label>
            <input type="text" name="kelamin" value="{{ session('user_kelamin') }}" readonly
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Nomor HP -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
            <input type="text" name="nomor_hp" value="{{ session('user_nomor_hp') }}" readonly
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" readonly
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ session('user_alamat') }}</textarea>
        </div>

        <!-- Pilih Jadwal Dokter -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Pilih Jadwal Dokter</label>
            <select name="schedule_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->schedule_id }}">
                        {{ $j->nama }} ({{ $j->poli }}) - {{ $j->hari }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $j->waktu)->format('H:i') }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Keluhan -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Keluhan</label>
            <textarea name="keluhan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="md:col-span-2 text-right">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Kirim Reservasi
            </button>
        </div>
    </form>
</section>
        </div>

        {{-- Section History --}}
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
                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $item->jadwal->waktu)->format('H:i') ?? '-' }}
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

        {{-- Section Dokter --}}
<div id="dokter" class="hidden text-gray-700">
    <section class="bg-gray-100 py-12 px-6 md:px-12">
        <h2 class="text-xl md:text-2xl font-semibold text-cyan-600 mb-8">
            <span class="text-cyan-500">Sipaling Serba Bisa</span>
            <span class="text-teal-600">Memberi Dokter Yang Kamu Butuhkan</span>
        </h2>

        <style>
            .parallelogram-right {
                transform: skewX(-15deg);
                display: inline-block;
            }
            .parallelogram-left {
                transform: skewX(15deg);
                display: inline-block;
            }
            .parallelogram-inner {
                transform: skewX(15deg);
                display: inline-block;
            }
            .parallelogram-inner-left {
                transform: skewX(-15deg);
                display: inline-block;
            }
        </style>

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
                {{-- Foto Dokter --}}
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 rounded-full border-8 border-cyan-400 overflow-hidden">
                        <img src="{{ $d['foto'] }}" alt="{{ $d['nama'] }}" class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Info Dokter --}}
                <div class="flex-1 w-full">
                    {{-- Nama Dokter --}}
                    <div class="parallelogram-left bg-cyan-600 mb-4">
                        <h3 class="text-xl md:text-2xl font-bold text-white px-4 py-1 parallelogram-inner-left">
                            {{ $d['nama'] }}
                        </h3>
                    </div>

                    {{-- Jadwal Mingguan --}}
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
                                    <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $jadwal_hari->waktu)->format('H:i') }}</p>
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Label Spesialisasi --}}
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
