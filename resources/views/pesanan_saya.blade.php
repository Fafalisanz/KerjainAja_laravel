<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - KerjainAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white shadow-sm px-[8%] py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-xl font-bold text-[#114d4d]">🦸 KerjainAja</a>
        <a href="{{ route('home') }}" class="text-sm font-semibold text-[#114d4d] hover:text-[#e65c00] transition">← Kembali ke Beranda</a>
    </nav>

    <div class="max-w-3xl mx-auto px-4 py-10">

        <div class="mb-7">
            <h1 class="text-2xl font-bold text-[#114d4d]">📋 Pesanan Saya</h1>
            <p class="text-sm text-gray-500 mt-1">Riwayat semua pesanan jasa yang telah kamu buat</p>
        </div>

        @if($pesanan->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm text-center py-20 px-6">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-bold text-[#114d4d] mb-2">Belum Ada Pesanan</h3>
                <p class="text-sm text-gray-400 mb-6">Kamu belum pernah memesan jasa. Yuk cari mitra terbaik sekarang!</p>
                <a href="{{ route('pencarian') }}"
                    class="inline-block bg-[#e65c00] hover:bg-[#c94f00] text-white font-semibold px-8 py-3 rounded-full transition">
                    Cari Jasa Sekarang
                </a>
            </div>
        @else
            @foreach($pesanan as $p)
            <div class="bg-white rounded-2xl shadow-sm border-l-4 border-[#114d4d] p-6 mb-4 hover:-translate-y-1 transition-transform">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $p->nama_pekerja }}</h3>
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

                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Durasi</p>
                        <p class="text-sm font-semibold text-gray-700 mt-1">⏱ {{ $p->durasi }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Pembayaran</p>
                        <p class="text-sm font-semibold text-gray-700 mt-1">💳 {{ $p->metode_pembayaran }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">No. Pesanan</p>
                        <p class="text-sm font-semibold text-gray-700 mt-1">#{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                @if($p->detail_pekerjaan)
                <div class="bg-gray-50 border-l-3 border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-500 mb-4">
                    <p class="text-xs text-gray-400 uppercase mb-1">Detail Pekerjaan</p>
                    {{ $p->detail_pekerjaan }}
                </div>
                @endif

                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-xs text-gray-400">Total Tagihan</p>
                        <p class="text-lg font-bold text-[#114d4d]">Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</p>
                    </div>
                    @if($p->status == 'Menunggu Pembayaran')
                        <a href="{{ route('tagihan', $p->id) }}"
                            class="bg-[#114d4d] hover:bg-[#0a3535] text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                            Lihat Tagihan →
                        </a>
                    @else
                        <span class="bg-gray-200 text-gray-400 text-sm font-semibold px-5 py-2.5 rounded-xl cursor-not-allowed">
                            {{ $p->status }}
                        </span>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</body>
</html>