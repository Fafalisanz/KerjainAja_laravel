<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KerjainAja - Solusi Jasa Suruhan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style_landing.css') }}" />
</head>
<body> 
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
    <div class="profile-dropdown" style="display:flex; align-items:center; gap:10px;">
        
        {{-- Ganti sapaan --}}
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
                {{-- Tambahkan role di sini --}}
                <small style="color:#000000; font-weight:600;">
                    {{ Auth::user()->role == 'mitra' ? '🦸 Mitra' : ' Pencari Jasa' }}
                </small>
            </div>
            <hr>
            <a href="{{ route('profil') }}">✏️ Edit Profil</a>
            <a href="#">📋 Pesanan Saya</a>
            <hr>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">🚪 Keluar</button>
            </form>
        </div>
    </div>
    @else
        <a href="{{ route('daftar') }}" class="btn-text">DAFTAR</a>
        <a href="{{ route('login') }}" class="btn-masuk">MASUK</a>
    @endauth
    
        </div>
    </header>

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

    <section class="freelance-section" id="daftar-pekerja">
        <h2>Daftar Pahlawan Kami</h2>

        <div class="filter-kategori">
            <button class="btn-filter active" onclick="jalankanFilter(event, 'semua')">Semua</button>
            @foreach($categories as $kat)
                <button class="btn-filter" onclick="jalankanFilter(event, '{{ $kat->keahlian }}')">
                    {{ $kat->keahlian }}
                </button>
            @endforeach
        </div>

        <div class="freelance-grid" id="freelance-list">
            @foreach($mitras as $row)
                <div class="freelance-card" data-kategori="{{ $row->keahlian }}">
                    <img src="{{ asset('Images/hero-img.png') }}" alt="{{ $row->nama_lengkap }}">
                    <h3>{{ $row->nama_lengkap }}</h3>
                    <p class="job-tag">{{ $row->keahlian }}</p>
                    <p style="color: #666; font-size: 14px;">Siap membantu pengerjaan {{ $row->keahlian }} di area {{ $row->kota }}.</p>
                    <a href="#" class="btn-detail">Lihat Profil</a>
                </div>
            @endforeach
        </div>
    </section>

    <section id="testimoni" class="testimoni bg-dark-green">
        <div class="container text-center" style="margin-bottom: 40px;">
            <h2 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 10px;">Apa Kata Mereka?</h2>
            <p style="color: #e0e0e0; font-size: 16px;">Kisah nyata dari para pencari jasa dan pekerja lokal yang telah terbantu</p>
        </div>

        <div class="testimoni-wrapper">
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
                    <p class="isi-testimoni">"Dokumen ketinggalan di rumah bisa dianter kilat. Bener-bener solusi buat yang sering teledor!"</p>
                </div>

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
                    <p class="isi-testimoni">"Dokumen ketinggalan di rumah bisa dianter kilat. Bener-bener solusi buat yang sering teledor!"</p>
                </div>
            </div>

            <div class="testimoni-track track-bottom">
                <div class="testimoni-card">
                    <h4>Pekerja Lokal</h4>
                    <img src="{{ asset('Images/foto-marcus.png') }}" alt="Marcus">
                    <h5>Marcus</h5>
                    <p class="status">Kurir & Driver</p>
                    <p class="isi-testimoni">"Platform ini adil banget buat pekerja lokal. Pendapatannya pasti..."</p>
                </div>
                <div class="testimoni-card">
                    <h4>Pekerja Lokal</h4>
                    <img src="{{ asset('Images/foto-dina.png') }}" alt="Dina">
                    <h5>Dina</h5>
                    <p class="status">Teknisi Mandiri</p>
                    <p class="isi-testimoni">"Sebagai teknisi perempuan, kadang susah cari klien. Sangat memberdayakan!"</p>
                </div>

                <div class="testimoni-card">
                    <h4>Pekerja Lokal</h4>
                    <img src="{{ asset('Images/foto-marcus.png') }}" alt="Marcus">
                    <h5>Marcus</h5>
                    <p class="status">Kurir & Driver</p>
                    <p class="isi-testimoni">"Platform ini adil banget buat pekerja lokal. Pendapatannya pasti..."</p>
                </div>
                <div class="testimoni-card">
                    <h4>Pekerja Lokal</h4>
                    <img src="{{ asset('Images/foto-dina.png') }}" alt="Dina">
                    <h5>Dina</h5>
                    <p class="status">Teknisi Mandiri</p>
                    <p class="isi-testimoni">"Sebagai teknisi perempuan, kadang susah cari klien. Sangat memberdayakan!"</p>
                </div>
            </div>
        </div>
    </section>

   <section id="faq" class="faq-section">
    <div class="container faq-layout">
        <div class="faq-left">
            <h2>Pertanyaan Seputar KerjainAja</h2>
            <div class="faq-list">
                <button class="faq-btn active" onclick="showAnswer('faq1', this)">Apa itu KerjainAja?</button>
                <button class="faq-btn" onclick="showAnswer('faq2', this)">Apakah aman menggunakan jasa KerjainAja?</button>
                <button class="faq-btn" onclick="showAnswer('faq3', this)">Bagaimana cara pembayaran jasanya?</button>
                <button class="faq-btn" onclick="showAnswer('faq4', this)">Bagaimana cara mendaftar sebagai pekerja/mitra?</button>
                <button class="faq-btn" onclick="showAnswer('faq5', this)">Apakah ada asuransi atau garansi jika terjadi masalah?</button>
                <button class="faq-btn" onclick="showAnswer('faq6', this)">Bagaimana jika pekerja tidak datang atau terlambat?</button>
            </div>
        </div>
        <div class="faq-right">
            <div class="faq-answer-card">
                <div class="faq-mascot-container">
                    <img src="{{ asset('Images/faq-mascot4.png') }}" alt="Maskot Pahlawan KerjainAja" class="faq-mascot" />
                </div>
                <h3 id="answer-title">Apa itu KerjainAja?</h3>
                <p id="answer-desc">KerjainAja adalah platform yang menghubungkan pencari jasa dengan pekerja lokal (mitra) untuk menyelesaikan berbagai tugas sehari-hari.</p>
            </div>
        </div>
    </div>
</section>

    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-col about-col">
                <img src="{{ asset('Images/logo1.png') }}" alt="Logo KerjainAja" class="footer-logo">
                <p>Platform jasa suruhan nomor 1. Apapun kebutuhanmu, serahkan pada pahlawan kami yang siap melayani dengan sepenuh hati.</p>
                <div class="social-links">
                    <a href="#"><img src="{{ asset('Images/icon-ig.png') }}" alt="Instagram"></a>
                    <a href="#"><img src="{{ asset('Images/icon-facebook.png') }}" alt="Facebook"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 KerjainAja. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>
   
    <script src="{{ asset('js/script_landing.js') }}"></script>
</body>
</html>