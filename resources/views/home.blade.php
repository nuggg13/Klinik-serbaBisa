<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Klinik SerbaBisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=aspect-ratio"></script>

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
<body class="bg-white text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white text-gray-800 flex items-center justify-between px-6 py-4 shadow-md">
        <div class="flex items-center">
            <img src="/images/logo_transparant_klinik.png" alt="Logo" class="w-24 ml-5">
        </div>
        <ul class="hidden md:flex gap-6">
            <li><a href="#" class="text-teal-400">Beranda</a></li>
            <li><a href="#" class="text-teal-400">Layanan</a></li>
            <li><a href="#" class="text-teal-400">Dokter yang tersedia</a></li>
        </ul>
        <div class="flex gap-2">
            <a href="#" class="bg-cyan-400 hover:bg-cyan-500 text-white px-4 py-1 rounded-full">Pasien</a>
            <a href="#" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-1 rounded-full">Admin</a>
        </div>
    </nav>

    {{-- Hero Banner --}}
    <div class="relative">
        <img src="/images/banner.png" class="w-full h-[500px] object-cover" alt="Dokter">
        <div class="absolute top-0 left-0 w-full h-[50%] bg-gradient-to-b from-white/90 to-black/30 z-10"></div>
        <div class="absolute top-1/2 left-0 w-full h-[50%] bg-black/30 z-10"></div>
        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 text-center z-20">
            <h2 class="text-white text-2xl md:text-4xl font-bold">
                <span class="text-cyan-400">Sipaling Serba Bisa</span> Melayani kebutuhan kesehatan mu
            </h2>
        </div>
    </div>

    {{-- Section Layanan Klinik --}}
    <section class="py-12 bg-gray-100">
        <h2 class="text-2xl md:text-3xl font-bold text-left mb-10 px-6 md:px-12">
            <span class="text-cyan-500">Sipaling Serba Bisa</span>
            <span class="text-teal-600">Memberi Layanan Yang Kamu Butuhkan</span>
        </h2>

        <div class="flex flex-col md:flex-row items-stretch w-full bg-white rounded-none shadow-md">
            <div class="relative w-full md:w-1/2 h-[300px] md:h-auto">
                <img src="/images/layanan-foto.png" alt="Layanan Klinik" class="w-full h-full object-cover">
                <div class="absolute inset-y-0 right-0 w-1/3 bg-gradient-to-l from-cyan-400/80 to-transparent"></div>
            </div>
            <div class="w-full md:w-1/2 bg-cyan-400 text-white flex items-center px-8 py-10">
                <div class="relative w-full">
                    <p class="text-3xl absolute -top-5 left-0">“</p>
                    <p class="text-lg leading-relaxed">
                        Untuk Anda dan keluarga, Klinik SerbaBisa hadir menyediakan berbagai layanan kesehatan berkualitas, lengkap dan terstandarisasi mulai dari layanan umum, tumbuh kembang anak, hingga pengobatan psikologi.
                    </p>
                    <p class="text-3xl absolute -bottom-5 right-0">”</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Grid Layanan Kami --}}
    <section class="bg-white py-12 px-6 md:px-12">
        <h2 class="text-xl md:text-2xl font-semibold text-teal-600 mb-6">Layanan Kami:</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $layanan = [
                    ['src' => '/images/Umum.png', 'alt' => 'Umum'],
                    ['src' => '/images/Gigi.png', 'alt' => 'Gigi'],
                    ['src' => '/images/Anak.png', 'alt' => 'Anak'],
                    ['src' => '/images/Vaksinasi.png', 'alt' => 'Vaksinasi dan Imunisasi'],
                    ['src' => '/images/Kehamilan.png', 'alt' => 'Kehamilan / KAI'],
                    ['src' => '/images/Laboratirium.png', 'alt' => 'Laboratorium / Diagnostik'],
                    ['src' => '/images/obat.png', 'alt' => 'Obat / Apotek'],
                    ['src' => '/images/Psikologi.png', 'alt' => 'Psikologi / Konseling'],
                    ['src' => '/images/Fisioterapi.png', 'alt' => 'Fisioterapi'],
                    ['src' => '/images/Mata.png', 'alt' => 'Mata'],
                ];
            @endphp

            @foreach ($layanan as $item)
            <div class="relative overflow-hidden rounded shadow">
                <div class="aspect-[16/9] w-full relative">
                    <img src="{{ $item['src'] }}" alt="{{ $item['alt'] }}" class="w-full object-cover">
                    <div class="absolute bottom-0 left-0 w-full h-[40%] bg-gradient-to-t from-cyan-600/70 to-transparent"></div>
                    <div class="absolute bottom-2 w-full text-center">
                        <p class="text-white font-semibold px-2 text-xl">{{ $item['alt'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

{{-- Section Dokter --}}
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
                ['nama' => 'Dr. El Prans sakyono', 'foto' => '/images/dokter/dokter-prana.png', 'spesialis' => 'Dokter Gigi'],
                ['nama' => 'Dr. Akhmad Akhnaf', 'foto' => '/images/dokter/dokter-ahnaf.png', 'spesialis' => 'Psikolog'],
                ['nama' => 'Dr. Fahrel Djayantara', 'foto' => '/images/dokter/dokter-farel.png', 'spesialis' => 'Dokter Mata'],
            ];
        @endphp

        @foreach ($dokter as $d)
        <div class="dokter-card p-6 flex flex-col md:flex-row items-center gap-6 shadow-md relative">
            {{-- Foto Dokter --}}
            <div class="flex-shrink-0">
                <div class="w-32 h-32 rounded-full border-8 border-cyan-400 overflow-hidden">
                    <img src="{{ $d['foto'] }}" alt="{{ $d['nama'] }}" class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Info Dokter --}}
            <div class="flex-1 w-full">
                {{-- Nama Dokter (Jajar Genjang) --}}
                <div class="parallelogram-left bg-cyan-600 mb-4">
                    <h3 class="text-xl md:text-2xl font-bold text-white px-4 py-1 parallelogram-inner-left">
                        {{ $d['nama'] }}
                    </h3>
                </div>

                {{-- Jadwal Mingguan --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2 text-center">
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">SUN</p>
                        <p>07:00 AM</p>
                    </div>
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">MON</p>
                        <p>-</p>
                    </div>
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">TUE</p>
                        <p>09:30 AM</p>
                    </div>
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">WED</p>
                        <p>-</p>
                    </div>
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">THU</p>
                        <p>09:30 AM</p>
                    </div>
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">FRI</p>
                        <p>09:30 AM</p>
                    </div>
                    <div class="bg-white px-3 py-2 rounded shadow text-sm">
                        <p class="font-semibold">SAT</p>
                        <p>07:00 AM</p>
                    </div>
                </div>
            </div>

            {{-- Label Spesialisasi (Jajar Genjang Kanan) --}}
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



</body>
</html>
