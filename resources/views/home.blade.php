<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Klinik SerbaBisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=aspect-ratio"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

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
            <a href="register" class="bg-cyan-400 hover:bg-cyan-500 text-white px-4 py-1 rounded-full">Pasien</a>
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
                ['nama' => 'Dr. El Prans sakyono', 'foto' => '/images/dokter/dokter-prana.png', 'spesialis' => 'Dokter Kehamilan'],
                ['nama' => 'Dr. Akhmad Akhnaf', 'foto' => '/images/dokter/dokter-ahnaf.png', 'spesialis' => 'Psikolog'],
                ['nama' => 'Dr. Fahrel Djayantara', 'foto' => '/images/dokter/dokter-farel.png', 'spesialis' => 'Dokter Mata'],
            ];

            $days = ['SUN' => 'Minggu', 'MON' => 'Senin', 'TUE' => 'Selasa', 'WED' => 'Rabu', 'THU' => 'Kamis', 'FRI' => 'Jumat', 'SAT' => 'Sabtu'];
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
                {{-- Nama Dokter --}}
                <div class="parallelogram-left bg-cyan-600 mb-4">
                    <h3 class="text-sm w-[530px] h-[42px] md:text-2xl font-bold text-white px-4 py-1 parallelogram-inner-left">
                        {{ $d['nama'] }}
                    </h3>
                </div>

                {{-- Jadwal Mingguan (Dynamic) --}}
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

<footer class="bg-cyan-500 text-white pt-[13px] rounded-t-[20px]">
  <div class="md:px-[113px] mx-auto">
<!-- Logo dan Deskripsi -->
<div class="flex flex-col md:flex-row justify-between items-center gap-6 border-b border-black pb-[10px] pr-[54px]">
  <div class="flex flex-row items-center gap-[30px] flex-1">
    <!-- Logo -->
    <img src="/images/logo_transparant_klinik1.png" alt="Klinik serbaBisa" class="w-[160px]">

    <!-- Deskripsi -->
    <p class="text-xs font-bold leading-[14px] align-middle">
      Klinik SerbaBisa hadir menyediakan berbagai layanan kesehatan berkualitas, lengkap dan terstandarisasi mulai dari layanan umum, tumbuh kembang anak, hingga pengobatan psikologi
    </p>
  </div>

  <!-- Ikon Sosial Media -->
  <div class="flex flex-wrap gap-3 md:gap-[10px]">
    <a href="#" class="text-white hover:opacity-80"><i class="fab fa-x-twitter text-xl"></i></a>
    <a href="#" class="text-white hover:opacity-80"><i class="fab fa-instagram text-xl"></i></a>
    <a href="#" class="text-white hover:opacity-80"><i class="fab fa-facebook text-xl"></i></a>
    <a href="#" class="text-white hover:opacity-80"><i class="fab fa-youtube text-xl"></i></a>
  </div>
</div>

<!-- Kontak & Pendaftaran -->
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 py-6">
  <!-- Kontak Kami -->
  <div>
    <h3 class="text-xl font-medium mb-[11px]">Kontak Kami:</h3>
    <ul class="grid grid-cols-2 md:grid-cols-4 gap-[15px]">
      <li class=""><i class="fab fa-youtube text-red-600 mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: Klinik serbaBisa</span></li>
      <li class=""><i class="fab fa-square-whatsapp text-green-500 mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: 0812-3456-7890</span></li>
      <li class=""><i class="fab fa-square-instagram text-pink-500 mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: @klinik_serbabisa</span></li>
      <li class=""><i class="fa-brands fa-square-facebook text-blue-600 mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: @klinik_serbabisa</span></li>
      <li class=""><i class="fas fa-envelope text-red-500 mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: KlinikserbaBisa@gmail.com</span></li>
      <li class=""><i class="fas fa-phone-volume text-blue-400 mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: 12345678910</span></li>
      <li class=""><i class="fa-brands fa-square-x-twitter text-black mr-[12px] w-[25px] text-[25px] align-middle"></i><span class="text-base font-medium align-middle">: @klinik_serbabisa</span></li>
    </ul>
  </div>
</div>


    <!-- Info layanan dan dokter -->
    <h3 class="text-xl font-medium">Pendaftaran & Layanan:</h3>
    <div class="mt-[11px] md:flex items-center">
              <!-- Pendaftaran -->
        <div class="flex flex-wrap gap-4 border-r border-black pr-[23px] h-[64px] items-center">
          <a href="#" class="bg-[#009997] text-white rounded-[20px] w-[152px] h-[27px] text-center align-center font-bold text-base hover:bg-gray-100">Pendaftaran Pasien</a>
          <a href="#" class="bg-[#009997] text-white rounded-[20px] w-[109px] h-[27px] text-center align-center font-bold text-base hover:bg-gray-100">Login Admin</a>
      </div>
      <div class="md:justify-center md:items-center ml-[23px] font-bold text-xs">
      <p class="mb-[14px]">
        <span class="text-[#009997]">Layanan:</span> Umum, Gigi, Anak, Vaksinasi & Imunisasi, KAI, Lab, Apotek, Fisioterapi, Mata
      </p>
      <p>
        <span class="text-[#009997]">Dokter:</span> Umum, Gigi, Anak, Vaksinasi & Imunisasi, KAI, Lab, Apotek, Fisioterapi, Mata
      </p>
      </div>
    </div>

</div>
    <!-- Copyright -->
    <div class="text-center border-t border-black mt-[11px] py-4 text-sm h-[60px]">
      Copyright © 2025 Klinik serbaBisa
    </div>
</footer>
</body>
</html>
