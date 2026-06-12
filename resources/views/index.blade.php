<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjainAja - Solusi Jasa Suruhan</title>
    
    {{-- Google Web Fonts & External Landing Stylesheet Definition --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style_landing.css') }}" />
</head>
<body> 

    {{-- COMPONENT NAVBAR NAVIGASI UTAMA  --}}
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('Images/hero-img.png') }}" alt="Logo KerjainAja" />
        </div>
        
        <nav>
            <a href="/">Beranda</a> 
            <a href="#layanan">Layanan</a>
            <a href="#testimoni">Testimoni</a>
            <a href="#faq">FAQ</a>
        </nav>
        
        <div class="nav-actions">
            @auth
                {{-- Kondisi Tampilan Akun Jika Pengguna Sudah Melakukan Login Sesi --}}
                <div class="profile-dropdown" style="display:flex; align-items:center; gap:10px;">
                    
                    <span class="sapaan-user">
                        @if(Auth::user()->role == 'mitra')
                            Halo, Mitra {{ Auth::user()->nama }}! 🦸
                        @else
                            Halo, {{ Auth::user()->nama }}! 👋
                        @endif
                    </span>

                    <img src="{{ asset('Images/profile/' . (Auth::user()->foto ?? 'default_profile.png')) }}"
                         onclick="toggleDropdown()"
                         style="width:55px; height:55px; border-radius:50%; cursor:pointer; object-fit:cover; border:2px solid #000000;">

                    <div class="profil-menu" id="profilMenu">
                        <div class="dropdown-header">
                        <strong>{{ Auth::user()->nama }}</strong>
                        <small>{{ Auth::user()->email }}</small>
                        <small @style([
                            'font-weight: 600',
                            'color: #dc3545' => Auth::user()->role == 'admin',
                            'color: #28a745' => Auth::user()->role == 'mitra',
                            'color: #007bff' => Auth::user()->role != 'admin' && Auth::user()->role != 'mitra'
                        ])>
                        {{ Auth::user()->role == 'admin' ? '👑 Admin' : (Auth::user()->role == 'mitra' ? '🧑‍💼 Mitra' : '👤 User') }}
                        </small>
                    </div>
                        <hr>
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}">👑 Dashboard Admin</a>
                        @endif
                        <a href="{{ route('profil') }}">✏️ Edit Profil</a>
                        @if(Auth::user()->role == 'mitra')
                            <a href="{{ route('pesanan.masuk') }}">📬 Pesanan Masuk</a>
                        @else
                            <a href="{{ route('pesanan.saya') }}">📋 Pesanan Saya</a>
                        @endif
                        <hr>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">🚪 Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Kondisi Tampilan Tombol Jika Pengguna Adalah Tamu / Guest --}}
                <a href="{{ route('daftar') }}" class="btn-text">DAFTAR</a>
                <a href="{{ route('login') }}" class="btn-masuk">MASUK</a>
            @endauth
        </div>
    </header>

    {{--  LAYOUT: HERO MARKETING BANNER  --}}
    <section class="hero">
        <div class="hero-content">
            <h1>Butuh Bantuan Mendadak ?</h1>
            <h2><span class="text-orange">“KerjainAja”</span> SOLUSINYA</h2>
            <p>
                <strong>Platform jasa suruhan nomor 1.</strong> Apapun kebutuhanmu,
                serahkan pada pahlawan kami yang siap melayani dengan sepenuh hati.
            </p>
            <div class="hero-buttons">
                <a href="#layanan" class="btn-primary">Cari Jasa Sekarang <span>&gt;</span></a>
                <a href="{{ route('mitra') }}" class="btn-outline">Gabung Jadi Mitra <span>&gt;</span></a>
            </div>
        </div>
        <div class="logo-image">
            <img src="{{ asset('Images/logo.png') }}" alt="Maskot KerjainAja" />
        </div>
    </section>

    {{-- LAYOUT: VISI & KELEBIHAN PLATFORM  --}}
    <section class="visi">
        <div class="visi-bg">
            <img src="{{ asset('Images/hero-bg-faded.png') }}" alt="Background Maskot" />
        </div>
        <div class="visi-content">
            <h3 class="visi-title">VISI</h3>
            <h2 class="visi-subtitle">Memberdayakan Pekerja Lokal, Membangun Ekonomi Berkelanjutan</h2>
            <p class="visi-desc">
                Kami hadir untuk memberikan perlindungan, peningkatan keahlian, dan
                penghasilan yang layak bagi setiap mitra. Bersama KerjainAja, setiap
                tugas adalah langkah menuju kesejahteraan bersama.
            </p>
        </div>

        {{-- Row Keunggulan Menggunakan Fitur Auto-Scroll Bergerak --}}
        <div class="cards-wrapper">
            <div class="cards-container">
                <div class="card">
                    <img src="{{ asset('Images/icon-jam.png') }}" alt="Waktu Fleksibel" />
                    <h4>Waktu Fleksibel</h4>
                    <p>Atur sendiri jadwal kerjamu. Kamu adalah pahlawan bagi waktumu sendiri.</p>
                </div>
                <div class="card">
                    <img src="{{ asset('Images/icon-dompet.png') }}" alt="Pendapatan Pasti" />
                    <h4>Pendapatan Pasti</h4>
                    <p>Sistem bagi hasil transparan yang memastikan setiap peluhmu terbayar layak.</p>
                </div>
                <div class="card">
                    <img src="{{ asset('Images/icon-kepalan.png') }}" alt="Dampak Sosial" />
                    <h4>Dampak Sosial</h4>
                    <p>Berdayakan ekonomi lokal dan jadilah bagian dari solusi lapangan kerja.</p>
                </div>
                <div class="card">
                    <img src="{{ asset('Images/icon-tameng.png') }}" alt="Asuransi Kerja" />
                    <h4>Asuransi Kerja</h4>
                    <p>Bekerja tanpa cemas dengan jaminan perlindungan kesehatan dan keselamatan.</p>
                </div>
                <div class="card">
                    <img src="{{ asset('Images/icon-timbangan.png') }}" alt="Perlindungan Hukum" />
                    <h4>Perlindungan Hukum</h4>
                    <p>Hak pekerja terjaga. Nikmati kontrak kerja yang transparan.</p>
                </div>
            </div>
        </div>
    </section>

    {{--  COMPONENT: BAR INPUT SEARCH UTAMA  --}}
    <section id="layanan" class="search-section">
        <div class="search-content">
            <h2>Apa yang Bisa Kami Bantu Hari Ini?</h2>
            <p>Temukan berbagai bantuan jasa profesional yang siap melayani kebutuhan mendadak Anda dengan cepat dan aman.</p>
            <form action="{{ route('pencarian') }}" method="GET" class="search-container">
                <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center;">
                    <img src="{{ asset('Images/icon-search.png') }}" class="search-icon" alt="Search" />
                </button>
                <input type="text" name="keyword" id="searchInput" placeholder="Cari jasa bantuan di sini..." required />
                <img src="{{ asset('Images/icon-mic.png') }}" class="mic-icon" alt="Voice Search" />
            </form>
        </div>
        <div class="search-mascot">
            <img src="{{ asset('Images/mascot-search.png') }}" class="mascot" alt="Mascot KerjainAja" />
        </div>
    </section>

    {{--  LAYOUT: GRID KATALOG DAFTAR PEKERJA  --}}
    <section class="freelance-section" id="daftar-pekerja">
        <h2>Daftar Pahlawan Kami</h2>

        {{-- Navigasi Tombol Filterisasi Jasa Kategori --}}
        <div class="filter-kategori">
            <button class="btn-filter active" onclick="jalankanFilter(event, 'semua')">Semua</button>
            @foreach($categories as $kat)
                <button class="btn-filter" onclick="jalankanFilter(event, '{{ $kat->keahlian }}')">
                    {{ $kat->keahlian }}
                </button>
            @endforeach
        </div>

        {{-- Kumpulan Grid Kartu Data Mitra Terdaftar --}}
        <div class="freelance-grid" id="freelance-list">
            @foreach($mitras as $row)
                <div class="freelance-card" data-kategori="{{ $row->keahlian }}">
                    <img src="{{ asset('Images/hero-img.png') }}" alt="{{ $row->nama_lengkap }}">
                    <h3>{{ $row->nama_lengkap }}</h3>
                    <p class="job-tag">{{ $row->keahlian }}</p>
                    <p style="color: #666; font-size: 14px;">Siap membantu pengerjaan {{ $row->keahlian }} di area {{ $row->kota }}.</p>
                    <a href="{{ route('detail', $row->id) }}" class="btn-detail">Lihat Profil</a>
                </div>
            @endforeach
        </div>
    </section>

    {{--  LAYOUT: SLIDER TRACK TESTIMONI USER  --}}
    <section id="testimoni" class="testimoni bg-dark-green">
        <div class="container text-center" style="margin-bottom: 40px;">
            <h2 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 10px;">Apa Kata Mereka?</h2>
            <p style="color: #e0e0e0; font-size: 16px;">Kisah nyata dari para pencari jasa dan pekerja lokal yang telah terbantu</p>
        </div>

        <div class="testimoni-wrapper">
            {{-- Track Atas: Testimoni Konsumen Pencari Jasa (Bergerak Kiri) --}}
            <div class="testimoni-track track-top">
                <div class="testimoni-card">
                    <h4>Pencari Jasa</h4>
                    <img src="{{ asset('Images/foto-david.png') }}" alt="David">
                    <h5>David</h5>
                    <p class="status">Karyawan Swasta</p>
                    <p class="isi-testimoni">"Asli, ngebantu banget! Pas lagi rapat dan butuh kirim dokumen mendadak"</p>
                </div>
                <div class="testimoni-card">
                    <h4>Pencari Jasa</h4>
                    <img src="{{ asset('Images/foto-vito.png') }}" alt="Vito">
                    <h5>Vito</h5>
                    <p class="status">Karyawan Kantor</p>
                    <p class="isi-testimoni">"Dokumen ketinggalan di rumah bisa dianter kilat. Bener-b