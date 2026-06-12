<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - KerjainAja</title>
    
    {{-- Google Web Fonts & External Assets Definition --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style_admin.css') }}">
</head>
<body>

    {{-- BARIS NAVIGASI UTAMA (SIDEBAR PANEL ADMIN) --}}
    <div class="sidebar">
        
        {{-- Area Identitas Logo Platform --}}
        <div class="sidebar-logo">
            <h2>KerjainAja</h2>
            <p>Admin Panel</p>
        </div>
        
        {{-- Blok Daftar Tautan Menu Navigasi dengan Pengecekan RouteIs Aktif --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            📊 Dashboard
        </a>
        <a href="{{ route('admin.mitra') }}" 
           class="{{ request()->routeIs('admin.mitra') ? 'active' : '' }}">
            👥 Kelola Mitra
        </a>
        <a href="{{ route('admin.pesanan') }}" 
           class="{{ request()->routeIs('admin.pesanan') ? 'active' : '' }}">
            📋 Kelola Pesanan
        </a>
        <a href="{{ route('admin.laporan') }}" 
           class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
            📄 Laporan
        </a>
        
        {{-- Akses Cepat Kembali Ke Beranda Web Utama --}}
        <a href="{{ route('home') }}" style="margin-top:auto; color:#e65c00;">
            🏠 Ke Website
        </a>
        
        {{-- Formulir Aksi Penghentian Sesi Autentikasi Admin (Logout) --}}
        <form action="{{ route('logout') }}" method="POST" style="padding: 14px 25px;">
            @csrf  
            <button type="submit" style="background:none; border:none; color:#ccc; cursor:pointer; font-family:'Poppins',sans-serif; font-size:14px;">
                🚪 Logout
            </button>
        </form>

    </div>{{-- Tutup container komponen .sidebar --}}

    {{-- BLOK KONTAINER UTAMA UNTUK MERENDER KONTEN KONTROLLER ANAK --}}
    <div class="main-content">
        @yield('content')
    </div>{{-- Tutup container komponen .main-content --}}

</body>
</html>