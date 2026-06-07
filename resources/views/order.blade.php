<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - {{ $nama_mitra }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_order.css') }}">
</head>
<body>
    <div class="order-container">
        <div class="header">
            <a href="{{ route('chat', $id) }}" class="back-btn">←</a>
            <h2>Detail Pesanan</h2>
        </div>

        <div class="info-card">
            <h3>{{ $nama_mitra }}</h3>
            <p>Pekerja Profesional</p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('order.proses') }}" method="POST">
            @csrf
            <input type="hidden" name="nama_pekerja" value="{{ $nama_mitra }}">
            <input type="hidden" name="mitra_id" value="{{ $data->id }}">

            <span class="section-title">Pilih Durasi Pengerjaan</span>
            <div class="duration-grid">
                <label class="duration-option">
                    <input type="radio" name="durasi" value="1 Hari" checked>
                    <div class="duration-label">1 Hari</div>
                </label>
                <label class="duration-option">
                    <input type="radio" name="durasi" value="3 Hari">
                    <div class="duration-label">3 Hari</div>
                </label>
                <label class="duration-option">
                    <input type="radio" name="durasi" value="7 Hari">
                    <div class="duration-label">7 Hari</div>
                </label>
                <label class="duration-option">
                    <input type="radio" name="durasi" value="Sesuai Chat">
                    <div class="duration-label">Sesuai Chat</div>
                </label>
            </div>

            <div class="form-group">
                <span class="section-title">Detail Pekerjaan / Alamat</span>
                <textarea name="detail" rows="3" placeholder="Contoh: Tolong perbaiki AC di ruang tamu..."></textarea>
            </div>

            <div class="escrow-banner">
                <span>🛡️</span>
                <div>
                    <strong>Pembayaran Aman (Escrow)</strong><br>
                    Dana Anda akan ditahan oleh sistem KerjainAja dan baru diteruskan setelah Anda mengonfirmasi pekerjaan selesai.
                </div>
            </div>

            <span class="section-title">Metode Pembayaran</span>
            <div class="payment-grid">
                <label class="payment-option">
                    <input type="radio" name="metode_pembayaran" value="Bank Transfer" checked>
                    <div class="payment-card"><span class="icon">🏦</span><span>Bank Transfer</span></div>
                </label>
                <label class="payment-option">
                    <input type="radio" name="metode_pembayaran" value="GoPay">
                    <div class="payment-card"><span class="icon">📱</span><span>GoPay / QRIS</span></div>
                </label>
                <label class="payment-option">
                    <input type="radio" name="metode_pembayaran" value="OVO/Dana">
                    <div class="payment-card"><span class="icon">💜</span><span>OVO / Dana</span></div>
                </label>
            </div>

            <button type="submit" class="btn-submit">Bayar Sekarang</button>
        </form>
    </div>
</body>
</html>