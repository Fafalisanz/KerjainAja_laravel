<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invoice Pembayaran - KerjainAja</title>
    
    {{-- Tailwind CSS CDN & Poppins Google Web Fonts Definition --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#f5f6fa] min-h-screen p-6 md:p-10">

    {{-- KONTAINER UTAMA HALAMAN INVOICE TAGIHAN ESKROW --}}
    <div class="max-w-5xl mx-auto space-y-6">
        
        {{-- ================= COMPONENT NAVBAR HEADER INVOICE STATUS ================= --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white px-8 py-6 rounded-2xl shadow-sm border border-gray-100 gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold uppercase tracking-widest bg-orange-50 text-[#e65c00] px-3 py-1 rounded-md border border-orange-100">Tagihan Pembayaran</span>
                    <h2 class="text-xl font-bold text-gray-800">Invoice #{{ 1000 + $data->id }}</h2>
                </div>
                <p class="text-xs text-gray-400 mt-1">Selesaikan pembayaran Anda sebelum batas waktu otomatis habis (24 Jam)</p>
            </div>
            
            {{-- Status Badge Indikator Sesi Transaksi --}}
            <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 px-4 py-2 rounded-xl">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">{{ $data->status }}</span>
            </div>
        </div>

        {{-- Grid Konten Utama: Terbagi Menjadi 2 Kolom (Kiri & Kanan) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            {{-- ================= KOLOM KIRI (INSTRUKSI TRANSFER OTOMATIS) ================= --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    {{-- Header Petunjuk Prosedur --}}
                    <div class="bg-[#0c4b4a] px-6 py-4 text-white flex items-center gap-3">
                        <span class="text-xl">💳</span>
                        <h3 class="text-sm font-semibold tracking-wide">Petunjuk Prosedur Pembayaran</h3>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        {{-- Box Render Teks Prosedur Pembayaran / Kode VA Dinamis --}}
                        <div class="bg-blue-50/60 rounded-xl p-5 border border-blue-100 flex items-start gap-4">
                            <div class="text-3xl bg-white p-2.5 rounded-xl shadow-sm border border-blue-100">💡</div>
                            <div class="space-y-1.5 flex-1 text-sm text-gray-600 leading-relaxed tagihan-instruction">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Metode Transfer Terpilih</h4>
                                {!! $instruksi !!}
                            </div>
                        </div>

                        {{-- Catatan Perlindungan Hukum Keamanan Escrow Bersama --}}
                        <div class="border-t border-gray-100 pt-5 space-y-3">
                            <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Syarat & Ketentuan Transaksi</h4>
                            <ul class="text-xs text-gray-500 space-y-2.5 list-inside list-disc pl-1">
                                <li>Pastikan nominal transfer sama persis hingga digit terakhir agar sistem dapat mendeteksi pembayaran secara instan.</li>
                                <li>Pembayaran ini menggunakan jaminan <span class="font-semibold text-[#0c4b4a]">Escrow Bersama</span>, uang Anda aman dan tidak langsung mengalir ke pekerja sebelum pekerjaan beres.</li>
                                <li>Setelah transfer berhasil dilakukan, Anda **wajib** menekan tombol konfirmasi pembayaran di sebelah kanan.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================= KOLOM KANAN (RINGKASAN PESANAN & ACTION BUTTON) ================= --}}
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-5">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Ringkasan Pesanan</h3>
                    </div>

                    {{-- Manifes Data Dinamis Target Transaksi --}}
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm py-1 border-b border-gray-50">
                            <span class="text-gray-400 font-medium">Nama Pekerja</span>
                            <span class="font-semibold text-gray-800">{{ $data->nama_pekerja }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm py-1 border-b border-gray-50">
                            <span class="text-gray-400 font-medium">Durasi Kerja</span>
                            <span class="font-semibold text-gray-700 bg-gray-100 px-2.5 py-0.5 rounded-md text-xs">{{ $data->durasi }}</span>
                        </div>
                    </div>

                    {{-- Akumulasi Total Tagihan Belanja Jasa --}}
                    <div class="bg-teal-50/50 border border-teal-100 rounded-xl p-4 flex justify-between items-center mt-2">
                        <div class="space-y-0.5">
                            <span class="text-[11px] font-bold text-teal-800 uppercase tracking-wider">Total Tagihan</span>
                            <p class="text-xs text-gray-400">Sudah termasuk pajak</p>
                        </div>
                        <span class="text-xl font-bold text-[#0c4b4a]">
                            Rp {{ number_format($data->total_tagihan, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- Tombol Trigger Aksi Pengiriman Request POST Verifikasi Pembayaran --}}
                    <div class="pt-2">
                        <button type="button" id="btnKonfirmasi"
                                class="w-full bg-[#e65c00] hover:bg-[#c94f00] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-600/10 transition-all transform hover:-translate-y-0.5 active:translate-y-0 text-center text-sm flex items-center justify-center gap-2">
                            <span>✅</span> Saya Sudah Bayar
                        </button>
                        <p class="text-[10px] text-center text-gray-400 mt-3 leading-relaxed">Pesanan Anda otomatis dibatalkan secara sistem jika masa tenggang 24 jam terlampaui tanpa adanya dana masuk.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Pemuatan Library SweetAlert2 & Logika Asynchronous Script Bawaan Proyek --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/tagihan.js') }}"></script>
    
</body>
</html>