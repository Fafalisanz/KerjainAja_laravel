<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - KerjainAja</title>
    
    {{-- Tailwind CSS CDN & Poppins Google Web Fonts Definition --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- ================= COMPONENT NAVBAR NAVIGASI ATAS ================= --}}
    <nav class="bg-white shadow-sm px-[8%] py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-xl font-bold text-[#114d4d]">🦸 KerjainAja</a>
        <a href="{{ route('home') }}" class="text-sm font-semibold text-[#114d4d] hover:text-[#e65c00] transition">← Kembali ke Beranda</a>
    </nav>

    {{-- KONTAINER UTAMA DASHBOARD LOG INBOX TRANS-MITRA --}}
    <div class="max-w-3xl mx-auto px-4 py-10">

        {{-- Judul Halaman & Sub-Informasi --}}
        <div class="mb-7">
            <h1 class="text-2xl font-bold text-[#114d4d]">📬 Pesanan Masuk</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar pesanan yang masuk untuk jasa kamu</p>
        </div>

        {{-- ================= BLOK WIDGET KARTU RINGKASAN DATA STATISTIK ================= --}}
        @if(!$pesanan->isEmpty())
            <div class="grid grid-cols-3 gap-4 mb-7">
                <div class="bg-white rounded-2xl shadow-sm p-5 text-center">
                    <p class="text-3xl font-bold text-[#114d4d]">{{ $pesanan->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total Pesanan</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm p-5 text-center">
                    <p class="text-3xl font-bold text-[#114d4d]">{{ $pesanan->where('status', 'Menunggu Pembayaran')->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Menunggu Pembayaran</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm p-5 text-center">
                    <p class="text-xl font-bold text-[#114d4d]">Rp {{ number_format($pesanan->sum('total_tagihan'), 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total Nilai Pesanan</p>
                </div>
            </div>
        @endif

        {{-- ================= ALUR KONDISI PERULANGAN LOG INBOX PESANAN ================= --}}
        @if($pesanan->isEmpty())
            
            {{-- Kondisi 1: Tampilan Jika Log Riwayat Transaksi Masih Kosong --}}
            <div class="bg-white rounded-2xl shadow-sm text-center py-20 px-6">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-bold text-[#114d4d] mb-2">Belum Ada Pesanan Masuk</h3>
                <p class="text-sm text-gray-400">Belum ada yang memesan jasa kamu. Pastikan profil kamu sudah lengkap!</p>
            </div>
            
        @else
            
            {{-- Kondisi 2: Looping Render Kartu Informasi Invoice Pesanan Masuk --}}
            @foreach($pesanan as $p)
                <div class="bg-white rounded-2xl shadow-sm border-l-4 border-[#e65c00] p-6 mb-4 hover:-translate-y-1 transition-transform">
                    
                    {{-- Baris Atas: Kode ID Seri Invoice Dan Label Tingkat Status --}}
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Pesanan #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</h3>
                            <p class="text-xs text-gray-400 mt-1">📅 {{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($p->status == 'Menunggu Pembayaran') bg-orange-50 text-orange-500
                            @elseif($p->status == 'Proses Verifikasi') bg-blue-50 text-blue-600
                            @elseif($p->status == 'Selesai') bg-green-50 text-green-600
                            @else bg-red-50 text-red-500 @endif">
                            {{ $p->status }}
                        </span>
                    </div>

                    {{-- Baris Tengah: Grid Pembagian Info Durasi, Metode, dan Nominal --}}
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Durasi</p>
                            <p class="text-sm font-semibold text-gray-700 mt-1">⏱ {{ $p->durasi }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Metode Bayar</p>
                            <p class="text-sm font-semibold text-gray-700 mt-1">💳 {{ $p->metode_pembayaran }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Total</p>
                            <p class="text-sm font-semibold text-gray-700 mt-1">Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Komponen Tambahan: Memo Catatan Instruksi Kerja dari Pembeli/Klien --}}
                    @if($p->detail_pekerjaan)
                        <div class="bg-orange-50 border-l-4 border-orange-200 rounded-lg px-4 py-3 text-sm text-gray-500 mb-4">
                            <p class="text-xs text-gray-400 uppercase mb-1">Detail Pekerjaan dari Klien</p>
                            {{ $p->detail_pekerjaan }}
                        </div>
                    @endif

                    {{-- Baris Bawah: Validasi Pengulangan Footer Lembar Invoice --}}
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">No. Pesanan: #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</p>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($p->status == 'Menunggu Pembayaran') bg-orange-50 text-orange-500
                            @elseif($p->status == 'Proses Verifikasi') bg-blue-50 text-blue-600
                            @elseif($p->status == 'Selesai') bg-green-50 text-green-600
                            @else bg-red-50 text-red-500 @endif">
                            {{ $p->status }}
                        </span>
                    </div>
                    
                </div>
            @endforeach
        @endif
        
    </div>
</body>
</html>