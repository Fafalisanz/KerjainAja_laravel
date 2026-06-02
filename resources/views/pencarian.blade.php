<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Jasa - KerjainAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_pencarian.css') }}">
</head>
<body>
    <div class="container">
        <div class="header-pencarian-modern">
            <div class="top-controls">
                <a href="{{ route('home') }}" class="back-link-modern">← Kembali</a>
                
                <div class="search-box-inline">
                    <form action="{{ route('pencarian') }}" method="GET">
                        <input type="text" name="keyword" 
                               placeholder="Cari jasa lain..." 
                               value="{{ $keyword }}">
                        <input type="hidden" name="wilayah" value="{{ $wilayah }}">
                        <button type="submit">Cari</button>
                    </form>
                </div>

                <div class="filter-box">
                    <form action="{{ route('pencarian') }}" method="GET" id="form-wilayah">
                        <input type="hidden" name="keyword" value="{{ $keyword }}">
                        <select name="wilayah" class="dropdown-modern" 
                                onchange="document.getElementById('form-wilayah').submit()">
                            <option value="semua" {{ $wilayah == 'semua' ? 'selected' : '' }}>Semua Wilayah</option>
                            <option value="Gresik" {{ $wilayah == 'Gresik' ? 'selected' : '' }}>Gresik</option>
                            <option value="Bangkalan" {{ $wilayah == 'Bangkalan' ? 'selected' : '' }}>Bangkalan</option>
                            <option value="Mojokerto" {{ $wilayah == 'Mojokerto' ? 'selected' : '' }}>Mojokerto</option>
                            <option value="Surabaya" {{ $wilayah == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                            <option value="Sidoarjo" {{ $wilayah == 'Sidoarjo' ? 'selected' : '' }}>Sidoarjo</option>
                            <option value="Lamongan" {{ $wilayah == 'Lamongan' ? 'selected' : '' }}>Lamongan</option>
                        </select>
                    </form>
                </div>
            </div>

            <hr class="garis-pembatas">

            <div class="results-info">
                <div>
                    <h2 class="judul-hasil">
                        Hasil untuk: <span class="keyword-highlight">"{{ $keyword }}"</span>
                    </h2>
                </div>
                <div class="lokasi-info">
                    <p>Menampilkan pekerja terdekat dari lokasimu:</p>
                    <h4 id="lokasi-user">📍 Mendeteksi lokasi...</h4>
                </div>
            </div>
        </div>

        <div class="card-grid">
            @forelse($mitras as $row)
                <div class="card" data-wilayah="{{ $row->kota }}">
                    <img src="{{ asset('Images/hero-img.png') }}" 
                         alt="Foto Pekerja" class="profile-img">
                    <h3 class="name">{{ $row->nama_lengkap }}</h3>
                    <p class="job">📌 {{ $row->keahlian }}</p>
                    <div class="rating-location">
                        <p class="rating">⭐ Baru <span>(0 Ulasan)</span></p>
                        <p class="location">📍 {{ $row->kota }}</p>
                    </div>
                    <a href="{{ route('detail', $row->id) }}" style="text-decoration:none;">
                        <button class="btn-order">Lihat Detail</button>
                    </a>
                </div>
            @empty
                <p style="text-align:center; grid-column: 1 / -1; color: #666;">
                    Maaf, jasa/keahlian <b>"{{ $keyword }}"</b> belum tersedia saat ini.
                </p>
            @endforelse
        </div>

        {{-- PAGINATION --}}
       <div class="pagination-wrapper">
    {{ $mitras->links('pagination::simple-bootstrap-4') }}
</div>

    </div>
    <script src="{{ asset('js/pencarian.js') }}"></script>
</body>
</html>