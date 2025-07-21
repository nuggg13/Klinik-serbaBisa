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

        {{-- Placeholder Sections --}}
        <div id="akun-pasien" class="section hidden"><h2 class="text-xl font-bold mb-4">Kelola Akun Pasien</h2></div>
        <div id="reservasi" class="section hidden"><h2 class="text-xl font-bold mb-4">Data Reservasi Pasien</h2></div>
        <div id="jadwal" class="section hidden"><h2 class="text-xl font-bold mb-4">Jadwal Dokter</h2></div>
        <div id="laporan" class="section hidden"><h2 class="text-xl font-bold mb-4">Laporan & Statistik</h2></div>
        <div id="riwayat" class="section hidden"><h2 class="text-xl font-bold mb-4">Riwayat Pasien</h2></div>
        <div id="akun-admin" class="section hidden"><h2 class="text-xl font-bold mb-4">Kelola Akun Admin</h2></div>

    </main>

    <script>
        function showSection(id) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(s => s.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
        }
    </script>

</body>
</html>
