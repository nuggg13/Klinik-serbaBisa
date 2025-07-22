<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Klinik SerbaBisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=aspect-ratio"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .dokter-card {
            background: linear-gradient(to right, #cffafe, #ffffff);
            border-radius: 100px 20px 20px 100px;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        }

        @media (min-width: 768px) {
            .dokter-card {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }
        }

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
</head>
<body class="bg-white text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white text-gray-800 flex items-center justify-between px-6 py-4 shadow-md">
        <div class="flex items-center">
            <img src="/images/logo_transparant_klinik.png" alt="Logo Klinik SerbaBisa" class="w-24 ml-5">
        </div>
        <ul class="hidden md:flex gap-6">
            <li><a href="#" class="text-teal-400 hover:text-teal-500">Beranda</a></li>
            <li><a href="#" class="text-teal-400 hover:text-teal-500">Layanan</a></li>
            <li><a href="#" class="text-teal-400 hover:text-teal-500">Dokter yang Tersedia</a></li>
        </ul>
        <div class="flex gap-2">
            <a href="register" class="bg-cyan-400 hover:bg-cyan-500 text-white px-4 py-1 rounded-full">Pasien</a>
            <a href="#" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-1 rounded-full">Admin</a>
        </div>
    </nav>

    <!-- Hero Banner -->
    <div class="relative">
        <img src="/images/banner.png" class="w-full h-[500px] object-cover" alt="Dokter">
        <div class="absolute top-0 left-0 w-full h-[50%] bg-gradient-to-b from-white/90 to-black/30 z-10"></div>
        <div class="absolute top-1/2 left-0 w-full h-[50%] bg-black/30 z-10"></div>
        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 text-center z-20">
            <h2 class="text-white text-2xl md:text-4xl font-bold">
                <span class="text-cyan-400">Sipaling Serba Bisa</span> Melayani Kebutuhan Kesehatanmu
            </h2>
        </div>
    </div>

    <!-- Section Layanan Klinik -->
    <section class="py-12 bg-gray-100">
        <h2 class="text-2xl md:text-3xl font-bold text-left mb-10 px-6 md:px-12">
            <span class="text-cyan-500">Sipaling Serba Bisa</span>
            <span class="text-teal-600">Memberi Layanan yang Kamu Butuhkan</span>
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
                        Untuk Anda dan keluarga, Klinik SerbaBisa hadir menyediakan berbagai layanan kesehatan berkualitas, lengkap, dan terstandarisasi mulai dari layanan umum, tumbuh kembang anak, hingga pengobatan psikologi.
                    </p>
                    <p class="text-3xl absolute -bottom-5 right-0">”</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Grid Layanan Kami -->
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
                    ['src' => '/images/Laboratorium.png', 'alt' => 'Laboratorium / Diagnostik'],
                    ['src' => '/images/Obat.png', 'alt' => 'Obat / Apotek'],
                    ['src' => '/images/Psikologi.png', 'alt' => 'Psikologi / Konseling'],
                    ['src' => '/images/Fisioterapi.png', 'alt' => 'Fisioterapi'],
                    ['src' => '/images/Mata.png', 'alt' => 'Mata'],
                ];
            @endphp
            @foreach ($layanan as $item)
            <div class="relative overflow-hidden rounded shadow">
                <div class="aspect-[16/9] w-full relative">
                    <img src="{{ $item['src'] }}" alt="{{ $item['alt'] }}" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 w-full h-[40%] bg-gradient-to-t from-cyan-600/70 to-transparent"></div>
                    <div class="absolute bottom-2 w-full text-center">
                        <p class="text-white font-semibold px-2 text-xl">{{ $item['alt'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Section Dokter -->
    <section class="bg-gray-100 py-12 px-6 md:px-12">
        <h2 class="text-xl md:text-2xl font-semibold text-cyan-600 mb-8">
            <span class="text-cyan-500">Sipaling Serba Bisa</span>
            <span class="text-teal-600">Memberi Dokter yang Kamu Butuhkan</span>
        </h2>
        <div class="grid grid-cols-1 gap-8">
            @php
                $dokter = [
                    ['nama' => 'DR. Tohir Arsyad Romadhon', 'foto' => '/images/dokter/dokter-tohir.png', 'spesialis' => 'Dokter Umum'],
                    ['nama' => 'Dr. Izzati Al Fahwas', 'foto' => '/images/dokter/dokter-izzat.png', 'spesialis' => 'Dokter Anak'],
                    ['nama' => 'Dr. El Prans Sakyono', 'foto' => '/images/dokter/dokter-prana.png', 'spesialis' => 'Dokter Kehamilan'],
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
                        <h3 class="text-sm md:text-2xl font-bold text-white px-4 py-1 parallelogram-inner-left">
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

    <!-- Footer -->
    <footer class="bg-cyan-500 text-white pt-4 rounded-t-3xl">
        <div class="container mx-auto px-6 md:px-28">
            <!-- Logo dan Deskripsi -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 border-b border-black pb-4">
                <div class="flex flex-col md:flex-row items-center gap-6 flex-1">
                    <img src="/images/logo_transparant_klinik1.png" alt="Klinik SerbaBisa" class="w-40">
                    <p class="text-sm font-bold leading-tight">
                        Klinik SerbaBisa hadir menyediakan berbagai layanan kesehatan berkualitas, lengkap, dan terstandarisasi mulai dari layanan umum, tumbuh kembang anak, hingga pengobatan psikologi.
                    </p>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="text-white hover:opacity-80"><i class="fa-brands fa-x-twitter text-xl"></i></a>
                    <a href="#" class="text-white hover:opacity-80"><i class="fa-brands fa-instagram text-xl"></i></a>
                    <a href="#" class="text-white hover:opacity-80"><i class="fa-brands fa-facebook-f text-xl"></i></a>
                    <a href="#" class="text-white hover:opacity-80"><i class="fa-brands fa-youtube text-xl"></i></a>
                </div>
            </div>

            <!-- Kontak Kami -->
            <div class="py-6">
                <h3 class="text-xl font-medium mb-4">Kontak Kami:</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <li><i class="fa-brands fa-youtube text-red-600 mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">Klinik SerbaBisa</span></li>
                    <li><i class="fa-brands fa-whatsapp text-green-500 mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">0812-3456-7890</span></li>
                    <li><i class="fa-brands fa-instagram text-pink-500 mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">@klinik_serbabi</span></li>
                    <li><i class="fa-brands fa-facebook text-blue-600 mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">@klinik_serbabi</span></li>
                    <li><i class="fa-solid fa-envelope text-red-500 mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">klinikserbabisa@gmail.com</span></li>
                    <li><i class="fa-solid fa-phone text-blue-400 mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">12345678910</span></li>
                    <li><i class="fa-brands fa-x-twitter text-black mr-3 text-2xl align-middle"></i><span class="text-base font-medium align-middle">@klinik_serbabi</span></li>
                </ul>
            </div>

            <!-- Pendaftaran & Layanan -->
            <div class="py-6">
                <h3 class="text-xl font-medium mb-4">Pendaftaran & Layanan:</h3>
                <div class="flex flex-col md:flex-row items-start gap-6">
                    <div class="flex gap-4">
                        <a href="#" class="bg-[#009997] text-white rounded-full px-6 py-2 font-bold text-base hover:bg-gray-100">Pendaftaran Pasien</a>
                        <a href="#" class="bg-[#009997] text-white rounded-full px-6 py-2 font-bold text-base hover:bg-gray-100">Login Admin</a>
                    </div>
                    <div class="flex-1 font-bold text-sm">
                        <p class="mb-4"><span class="text-[#009997]">Layanan:</span> Umum, Gigi, Anak, Vaksinasi & Imunisasi, KAI, Laboratorium, Apotek, Fisioterapi, Mata</p>
                        <p><span class="text-[#009997]">Dokter:</span> Umum, Gigi, Anak, Vaksinasi & Imunisasi, KAI, Laboratorium, Apotek, Fisioterapi, Mata</p>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center border-t border-black py-4 text-sm">
                Copyright © 2025 Klinik SerbaBisa
            </div>
        </div>
    </footer>
</body>
</html>