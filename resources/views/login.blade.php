<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Klinik SerbaBisa</title>
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

                {{-- Error Validasi --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Judul --}}
                    <h2 class="text-3xl font-bold text-center text-gray-700">WELCOME</h2>

                    {{-- Subjudul --}}
                    <p class="text-sm text-center text-gray-500 mb-4">
                        Masuk ke akun Anda sekarang untuk melakukan reservasi janji temu di klinik
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

                    {{-- Belum punya akun --}}
                    <div class="text-sm text-gray-600 text-center">
                        Belum punya akun?
                        <a href="{{ url('/register') }}" class="text-red-500 hover:underline font-semibold">Daftar Disini</a>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-center">
                        <button type="submit"
                            class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-full">
                            Masuk
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>
