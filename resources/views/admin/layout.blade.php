<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - KerjainAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style_admin.css') }}">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <h2>KerjainAja</h2>
        <p>Admin Panel</p>
    </div>
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
    <a href="{{ route('home') }}" style="margin-top:auto; color:#e65c00;">
        🏠 Ke Website
    </a>
    <form action="{{ route('logout') }}" method="POST" style="padding: 14px 25px;">
        @csrf  
        <button type="submit" style="background:none; border:none; color:#ccc; 
                cursor:pointer; font-family:'Poppins',sans-serif; font-size:14px;">
            🚪 Logout
        </button>
    </form>
</div>{{-- tutup .sidebar --}}

<div class="main-content">
    @yield('content')
</div>{{-- tutup .main-content --}}

</body>
</html>