<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran - KerjainAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_tagihan.css') }}">
</head>
<body>

    <div class="invoice-card">
        <div class="invoice-header">
            <h1>Invoice #{{ 1000 + $data->id }}</h1>
            <p>Selesaikan pembayaran Anda</p>
        </div>

        <div class="invoice-body">
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Pekerja</span>
                    <span class="info-value">{{ $data->nama_pekerja }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Durasi</span>
                    <span class="info-value">{{ $data->durasi }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value" style="color:#F2994A;">{{ $data->status }}</span>
                </div>
            </div>

            <div class="total-section">
                <span class="total-label">Total Tagihan</span>
                <span class="total-amount">
                    Rp {{ number_format($data->total_tagihan, 0, ',', '.') }}
                </span>
            </div>

            <div class="payment-instruction">
                {!! $instruksi !!}
            </div>

            <button type="button" id="btnKonfirmasi" class="btn-confirm">
                Saya Sudah Bayar
            </button>
            <p style="text-align:center; font-size:12px; color:#aaa; margin-top:15px;">
                Otomatis batal dalam 24 jam jika tidak dibayar
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/tagihan.js') }}"></script>
</body>
</html>