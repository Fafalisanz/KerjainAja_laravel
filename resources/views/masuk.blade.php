<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KerjainAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    {{-- Kiri --}}
    <div class="hidden lg:flex w-1/2 bg-[#1a4a52] flex-col items-center justify-center p-12 text-white">
        <img src="{{ asset('Images/logo.png') }}" alt="Logo" class="w-64 mb-8">
        <h2 class="text-3xl font-bold mb-4 text-center">Selamat Datang Kembali!</h2>
        <p class="text-center text-gray-300 text-base leading-relaxed max-w-sm">
            Senang melihatmu lagi. Yuk, selesaikan pekerjaanmu hari ini bersama KerjainAja.
        </p>
    </div>

    {{-- Kanan --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="text-[#1a4a52] font-semibold text-sm hover:text-[#e65c00] transition mb-6 inline-block">
                ← Kembali ke Beranda
            </a>
            <h2 class="text-2xl font-bold text-[#1a4a52] mb-6">Masuk ke Akun Anda</h2>

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg px-4 py-3 mb-4 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a4a52]" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                    <input type="password" name="password"
                        placeholder="Masukkan kata sandi"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a4a52]" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="text-right">
                    <a href="#" class="text-sm text-[#e65c00] font-semibold hover:underline">Lupa Kata Sandi?</a>
                </div>
                <button type="submit"
                    class="w-full bg-[#e65c00] hover:bg-[#c94f00] text-white font-bold py-3 rounded-xl transition">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun?
                <a href="{{ route('daftar') }}" class="text-[#e65c00] font-semibold hover:underline">Daftar</a>
            </p>
        </div>
    </div>

</body>
</html>