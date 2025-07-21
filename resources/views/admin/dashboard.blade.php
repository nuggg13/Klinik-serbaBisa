<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md px-4 py-6">
            <h2 class="text-xl font-bold mb-6 text-blue-600">Dashboard Admin</h2>
            <nav class="space-y-4">
                <a href="#" onclick="showSection('dataPasien')" class="block text-gray-700 hover:text-cyan-500 font-medium">Data Pasien</a>
                <a href="#" onclick="showSection('jadwal')" class="block text-gray-700 hover:text-cyan-500 font-medium">Jadwal Dokter</a>
                <a href="#" onclick="showSection('reservasi')" class="block text-gray-700 hover:text-cyan-500 font-medium">Data Reservasi</a>
                <a href="{{ route('admin.logout') }}" class="block text-red-500 hover:underline font-medium mt-4">Logout</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Selamat datang, Admin {{ session('admin_nama') }}</h1>

            {{-- Section: Data Pasien --}}
            <div id="dataPasien" class="hidden bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Data Pasien</h2>
                {{-- Tabel data pasien akan diletakkan di sini --}}
                <p class="text-gray-500">Belum ada data ditampilkan.</p>
            </div>

            {{-- Section: Jadwal --}}
            <div id="jadwal" class="hidden bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Jadwal Dokter</h2>
                {{-- Tabel data jadwal dokter akan diletakkan di sini --}}
                <p class="text-gray-500">Belum ada data ditampilkan.</p>
            </div>

            {{-- Section: Reservasi --}}
            <div id="reservasi" class="hidden bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Data Reservasi</h2>
                {{-- Tabel data reservasi akan diletakkan di sini --}}
                <p class="text-gray-500">Belum ada data ditampilkan.</p>
            </div>
        </main>
    </div>

    <script>
        function showSection(id) {
            document.querySelectorAll('main > div').forEach(div => {
                div.classList.add('hidden');
            });
            document.getElementById(id).classList.remove('hidden');
        }

        // Default tampilkan Data Pasien
        showSection('dataPasien');
    </script>

</body>
</html>
