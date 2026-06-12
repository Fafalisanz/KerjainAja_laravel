<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - KerjainAja</title>
    
    {{-- Tailwind CSS CDN & Poppins Google Web Fonts Definition --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    {{-- ================= SISI KIRI (ILUSTRASI & LOGO BRAND) ================= --}}
    <div class="hidden lg:flex w-1/2 bg-[#1a4a52] flex-col items-center justify-center p-12 text-white">
        <img src="{{ asset('Images/logo.png') }}" alt="Logo" class="w-64 mb-8">
        <h2 class="text-3xl font-bold mb-4 text-center">Gabung dengan Kami!</h2>
        <p class="text-center text-gray-300 text-base leading-relaxed max-w-sm">
            Jadilah bagian dari komunitas KerjainAja dan temukan kemudahan dalam setiap pekerjaanmu.
        </p>
    </div>

    {{-- ================= SISI KANAN (FORMULIR REGISTRASI USER) ================= --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            
            {{-- Tautan Navigasi Kembali ke Landing Page --}}
            <a href="{{ route('home') }}" class="text-[#1a4a52] font-semibold text-sm hover:text-[#e65c00] transition mb-6 inline-block">
                ← Kembali ke Beranda
            </a>
            
            <h2 class="text-2xl font-bold text-[#1a4a52] mb-6">Buat Akun Baru</h2>

            {{-- Komponen Notifikasi Pesan Kesalahan / Error Gagal Registrasi --}}
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg px-4 py-3 mb-4 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Formulir Input Data Pengguna Baru --}}
            <form action="{{ route('daftar.proses') }}" method="POST" class="space-y-4">
                @csrf
                
                {{-- Input: Nama Lengkap --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           placeholder="Masukkan nama lengkap"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a4a52]" required>
                    @error('nama') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>
                
                {{-- Input: Alamat Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="Masukkan email Anda"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a4a52]" required>
                    @error('email') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>
                
                {{-- Input: Kata Sandi (Password) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                    <input type="password" name="password"
                           placeholder="Buat kata sandi baru"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a4a52]" required>
                    @error('password') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>
                
                {{-- Input: Validasi Ulang Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation"
                           placeholder="Ulangi kata sandi"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a4a52]" required>
                </div>
                
                {{-- Tombol Kirim Form Pendaftaran --}}
                <button type="submit"
                        class="w-full bg-[#e65c00] hover:bg-[#c94f00] text-white font-bold py-3 rounded-xl transition">
                    Daftar
                </button>
            </form>

            {{-- Tautan Alternatif Menuju Halaman Login/Masuk Sesi --}}
            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-[#e65c00] font-semibold hover:underline">Masuk</a>
            </p>
            
        </div>
    </div>

</body>
</html>