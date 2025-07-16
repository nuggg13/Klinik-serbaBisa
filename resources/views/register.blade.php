<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Klinik SerbaBisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        {{-- Gambar Kiri --}}
        <div class="hidden md:block md:w-1/2">
            <img src="/images/poster-login.png" alt="Gambar Register" class="w-full h-full object-contain">
        </div>

        {{-- Form Kanan --}}
        <div class="w-full md:w-1/2 bg-white flex items-center justify-center p-8">
            <form action="#" method="POST" class="w-full max-w-md space-y-5">
                {{-- @csrf jika nanti pakai backend --}}

                {{-- Judul --}}
                <h2 class="text-3xl font-bold text-center text-gray-700">WELCOME</h2>

                {{-- Subjudul --}}
                <p class="text-sm text-center text-gray-500 mb-4">
                    Masuk ke akun Anda sekarang untuk melakukan reservasi janji temu di klinik
                </p>

                {{-- Email --}}
                <div>
                    <label class="block text-gray-600">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-cyan-400">
                </div>

                {{-- Nama --}}
                <div>
                    <label class="block text-gray-600">Nama</label>
                    <input type="text" name="nama" class="w-full border rounded px-4 py-2">
                </div>

                {{-- Umur & Kelamin --}}
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-gray-600">Umur</label>
                        <input type="number" name="umur" class="w-full border rounded px-4 py-2">
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-600">Jenis Kelamin</label>
                        <select name="kelamin" class="w-full border rounded px-4 py-2">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div>
                    <label class="block text-gray-600">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="w-full border rounded px-4 py-2">
                </div>

                {{-- Alamat --}}
                <div>
                    <label class="block text-gray-600">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full border rounded px-4 py-2"></textarea>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-gray-600">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-4 py-2">
                </div>

                {{-- Sudah punya akun --}}
                <div class="text-sm text-gray-600 text-center">
                    Sudah punya akun? 
                    <a href="{{ url('/login') }}" class="text-red-500 hover:underline font-semibold">Login Disini</a>
                </div>

                {{-- Tombol --}}
                <div class="text-center">
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-full">
                        Daftar Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
