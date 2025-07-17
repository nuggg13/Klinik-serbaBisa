<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h2 class="text-xl font-bold mb-4">Daftar Dokter</h2>
            <p>Konten dokter akan ditambahkan nanti.</p>
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
