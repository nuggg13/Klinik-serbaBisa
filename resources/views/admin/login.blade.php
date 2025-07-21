<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Klinik SerbaBisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        {{-- Gambar Kiri --}}
        <div class="hidden md:block md:w-1/2">
            <img src="/images/poster-login.png" alt="Gambar Login" class="w-full h-full object-contain">
        </div>

        {{-- Form Kanan --}}
        <div class="w-full md:w-1/2 bg-white flex items-center justify-center p-8">
            <div class="w-full max-w-md space-y-5">

                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded text-center">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error --}}
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded text-center">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Form Login --}}
                <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Judul --}}
                    <h2 class="text-3xl font-bold text-center text-gray-700">ADMIN LOGIN</h2>

                    {{-- Subjudul --}}
                    <p class="text-sm text-center text-gray-500 mb-4">
                        Masuk ke akun admin untuk mengelola sistem reservasi
                    </p>

                    {{-- Email --}}
                    <div>
                        <label class="block text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-cyan-400">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-gray-600">Password</label>
                        <input type="password" name="password"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-cyan-400">
                    </div>

                    {{-- Tombol --}}
                    <div class="text-center">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-full">
                            Masuk Admin
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
