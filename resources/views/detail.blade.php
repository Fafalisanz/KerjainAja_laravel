<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil - {{ $data->nama_lengkap }}</title>
    
    {{-- Google Web Fonts & External Profile Stylesheet Definition --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_detail.css') }}">
</head>
<body>

    {{-- KONTAINER UTAMA HALAMAN DETAIL PROFIL MITRA --}}
    <div class="container-detail">
        
        {{-- Tombol Navigasi Kembali ke Halaman Pencarian --}}
        <a href="{{ route('pencarian') }}" class="nav-back">← Kembali</a>

        {{-- ================= KARTU HEADER UTAMA PROFIL ================= --}}
        <div class="profile-header-card">

            {{-- Foto Sampul (Cover Banner) --}}
            <div class="cover-photo">
                <div class="btn-ikuti">⊕ Ikuti</div>
            </div>

            {{-- Blok Informasi Utama Akun Mitra --}}
            <div class="profile-info">
                <img src="{{ asset('Images/hero-img.png') }}" alt="Foto Profil" class="foto-bulat">

                <div class="name-title">
                    <h1>{{ $data->nama_lengkap }}</h1>
                    <p>{{ $data->keahlian }}</p>
                </div>

                {{-- Baris Barometer Statistik Rating, Lokasi, dan Range Harga --}}
                <div class="stats-row">
                    <div>⭐ 4.8 (120)</div>
                    <div>📍 {{ $data->kota }}</div>
                    <div>💰 80rb - 200rb</div>
                </div>

                {{-- Kelompok Tombol Interaksi Aksi (Chat & Order) --}}
                <div class="action-buttons">
                    <a href="{{ route('chat', $id) }}" class="btn-chat-outline">Chat</a>
                    <a href="{{ route('order', $id) }}" class="btn-pesan-solid">Pesan</a>
                </div>
            </div>
            
        </div>

        {{-- ================= BOX KONTEN INFORMASI TAMBAHAN ================= --}}
        
        {{-- Deskripsi Ringkas Profil Pekerja --}}
        <div class="info-box">
            <h3>Tentang Saya</h3>
            <p>Halo! Saya adalah ahli di bidang <strong>{{ $data->keahlian }}</strong> berdomisili di <strong>{{ $data->kota }}</strong>. Saya siap membantu kebutuhan Anda dengan profesional dan tepat waktu.</p>
        </div>

        {{-- Daftar Koleksi Layanan yang Ditawarkan (Looping Data Array) --}}
        <div class="info-box">
            <h3>Layanan</h3>
            <ul class="layanan-list">
                @foreach($array_layanan as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            </ul>
        </div>

    </div>

</body>
</html>