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
            <h2 class="text-xl font-bold mb-6">Daftar Reservasi</h2>

            <div class="space-y-4">
                <div class="flex justify-between items-center bg-white p-5 rounded shadow">
                    <div>
                        <h3 class="font-semibold text-lg">Reservasi Poli Umum</h3>
                        <p class="text-sm text-gray-500">Tanggal: 15 Juli 2025</p>
                        <p class="text-sm text-gray-500">Jam: 10.00 WIB</p>
                    </div>
                    <div class="text-right">
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Belum</span>
                        <button class="mt-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 text-sm rounded">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section History --}}
        <div id="history" class="hidden text-gray-700">
            <h2 class="text-xl font-bold mb-6">Riwayat Reservasi</h2>

            <div class="space-y-4">
                <div class="flex justify-between items-center bg-white p-5 rounded shadow">
                    <div>
                        <h3 class="font-semibold text-lg">Reservasi Gigi</h3>
                        <p class="text-sm text-gray-500">Tanggal: 10 Juli 2025</p>
                        <p class="text-sm text-gray-500">Jam: 13.00 WIB</p>
                    </div>
                    <div class="text-right">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Selesai</span>
                    </div>
                </div>
                <div class="flex justify-between items-center bg-white p-5 rounded shadow">
                    <div>
                        <h3 class="font-semibold text-lg">Reservasi Psikologi</h3>
                        <p class="text-sm text-gray-500">Tanggal: 8 Juli 2025</p>
                        <p class="text-sm text-gray-500">Jam: 09.00 WIB</p>
                    </div>
                    <div class="text-right">
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">Gagal</span>
                    </div>
                </div>
            </div>
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
