<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - {{ $nama_mitra }}</title>
    
    {{-- Tailwind CSS CDN & Poppins Google Web Fonts Definition --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        input[type="radio"]:checked + .duration-label {
            background: #0c4b4a; color: white; border-color: #0c4b4a;
        }
        input[type="radio"]:checked + .payment-card {
            border-color: #e65c00; background: #fff5f0;
        }
    </style>
</head>
<body class="bg-[#f5f6fa] min-h-screen p-6 md:p-10">

    {{-- KONTAINER UTAMA HALAMAN CHECKOUT PEMESANAN JASA --}}
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header Atas Full-Width & Tombol Kembali ke Ruang Chat --}}
        <div class="flex items-center gap-4 bg-white px-6 py-5 rounded-2xl shadow-sm border border-gray-100">
            <a href="{{ route('chat', $id) }}" class="text-[#0c4b4a] text-2xl font-bold hover:text-[#e65c00] transition-colors">←</a>
            <div>
                <h2 class="text-xl font-bold text-[#1a1a1a]">Formulir Buat Pesanan</h2>
                <p class="text-xs text-gray-400 mt-0.5">Silakan lengkapi detail instruksi kerja dan pembayaran Anda</p>
            </div>
        </div>

        {{-- Komponen Notifikasi Sesi Pesan Sukses --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 rounded-xl px-5 py-4 text-sm shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORMULIR UTAMA: PROSES TRANSMISI DATA ORDER --}}
        <form action="{{ route('order.proses') }}" method="POST">
            @csrf
            
            {{-- Data Payload Tersembunyi untuk Relasi Database Controller --}}
            <input type="hidden" name="nama_pekerja" value="{{ $nama_mitra }}">
            <input type="hidden" name="mitra_id" value="{{ $data->id }}">

            {{-- Grid Konten Utama: Terbagi Menjadi 2 Kolom (Kiri & Kanan) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                
                {{-- ================= KOLOM KIRI (SPESIFIKASI ORDER & DURASI) ================= --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Box Komponen Detail Input Pekerjaan --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                        <div class="border-b border-gray-100 pb-3">
                            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Spesifikasi Order</h3>
                        </div>
                        
                        {{-- Pilihan Radio Button Durasi Kerja --}}
                        <div>
                            <p class="text-sm font-semibold text-gray-700 mb-3">Pilih Durasi Pengerjaan</p>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                @foreach(['1 Hari', '3 Hari', '7 Hari', 'Sesuai Chat'] as $durasi)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="durasi" value="{{ $durasi }}" class="hidden"
                                            {{ $durasi == '1 Hari' ? 'checked' : '' }}>
                                        <div class="duration-label text-center border-2 border-gray-200 rounded-xl py-3.5 text-xs font-semibold text-gray-600 transition-all hover:border-[#0c4b4a]">
                                            {{ $durasi }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Input Teks Deskripsi Instruksi Kerja --}}
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-sm font-semibold text-gray-700">Detail Pekerjaan / Alamat Lengkap</p>
                                <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-md font-medium">Opsional</span>
                            </div>
                            <textarea name="detail" rows="6"
                                      placeholder="Contoh: Tolong perbaiki AC di ruang tamu, air menetes dan tidak dingin. (Bisa dikosongkan jika sudah sepakat lewat chat)..."
                                      class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#0c4b4a] resize-none transition-all"></textarea>
                        </div>
                    </div>

                    {{-- Escrow Banner Keamanan Rekening Bersama --}}
                    <div class="flex items-center gap-4 bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4 shadow-inner">
                        <span class="text-3xl bg-white p-2 rounded-xl shadow-sm">🛡️</span>
                        <div class="text-xs text-gray-600 leading-relaxed">
                            <strong class="text-emerald-900 text-sm block mb-0.5">Sistem Pembayaran Rekening Bersama (Escrow) Amankan Transaksi Anda!</strong>
                            Dana Anda akan ditahan dengan aman oleh sistem internal <span class="font-semibold text-[#0c4b4a]">KerjainAja</span>. Pembayaran baru dicairkan dan diteruskan ke pihak mitra penyedia jasa setelah Anda menyetujui serta mengonfirmasi bahwa pekerjaan telah diselesaikan dengan baik.
                        </div>
                    </div>
                </div>

                {{-- ================= KOLOM KANAN (INFO MITRA & METODE PEMBAYARAN) ================= --}}
                <div class="space-y-6">
                    
                    {{-- Kartu Nama Target Mitra Penyedia Jasa Terpilih --}}
                    <div class="bg-gradient-to-br from-[#0c4b4a] to-[#083332] rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 text-white/5 text-9xl font-bold select-none">KA</div>
                        <p class="text-xs text-teal-200 uppercase tracking-widest font-semibold mb-1">Penyedia Jasa Terpilih</p>
                        <h3 class="text-xl font-bold tracking-wide mb-1">{{ $nama_mitra }}</h3>
                        <div class="inline-flex items-center gap-1.5 bg-white/10 px-3 py-1 rounded-full text-xs font-medium text-teal-100 backdrop-blur-sm mt-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block animate-pulse"></span>
                            Mitra Profesional Terverifikasi
                        </div>
                    </div>

                    {{-- Pilihan Radio Button Daftar Metode Pembayaran Escrow --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                        <div class="border-b border-gray-100 pb-3">
                            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Metode Pembayaran</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-3">
                            @foreach([['Bank Transfer','🏦'], ['GoPay','📱'], ['OVO/Dana','💜']] as $m)
                                <label class="cursor-pointer w-full">
                                    <input type="radio" name="metode_pembayaran" value="{{ $m[0] }}" class="hidden"
                                        {{ $m[0] == 'Bank Transfer' ? 'checked' : '' }}>
                                    <div class="payment-card flex items-center gap-4 border-2 border-gray-100 rounded-xl px-4 py-3.5 transition-all hover:border-[#e65c00] bg-gray-50/50">
                                        <div class="text-2xl bg-white w-10 h-10 rounded-lg shadow-sm flex items-center justify-center">{{ $m[1] }}</div>
                                        <div class="text-sm font-bold text-gray-700">{{ $m[0] }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        {{-- Tombol Aksi Konfirmasi Submit Invoice --}}
                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full bg-[#e65c00] hover:bg-[#c94f00] text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-600/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0 text-center text-sm">
                                Konfirmasi & Bayar Sekarang
                            </button>
                            <p class="text-[11px] text-center text-gray-400 mt-3">Dengan menekan tombol, Anda menyetujui seluruh ketentuan layanan KerjainAja.</p>
                        </div>
                    </div>

                </div>
                
            </div>
        </form>
    </div>

    {{-- SCRIPT JAVASCRIPT: LOGIKA RESET STATE CLASS RADIO BUTTON ACTIVE --}}
    <script>
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const name = this.name;
                document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                    const label = r.nextElementSibling;
                    label.classList.remove('bg-[#0c4b4a]', 'text-white', 'border-[#0c4b4a]', 'border-[#e65c00]', 'bg-[#fff5f0]');
                    label.classList.add('border-gray-100');
                });
                const selected = this.nextElementSibling;
                if (name === 'durasi') {
                    selected.classList.add('bg-[#0c4b4a]', 'text-white', 'border-[#0c4b4a]');
                } else {
                    selected.classList.add('border-[#e65c00]', 'bg-[#fff5f0]');
                }
            });
        });
    </script>
    
</body>
</html>