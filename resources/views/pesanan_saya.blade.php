<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - KerjainAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f4f7f7; min-height: 100vh; }

        .navbar {
            background: white;
            padding: 16px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .navbar a.logo { text-decoration: none; font-size: 20px; font-weight: 700; color: #114d4d; }
        .navbar a.back { text-decoration: none; color: #114d4d; font-weight: 600; font-size: 14px; }
        .navbar a.back:hover { color: #e65c00; }

        .page-wrapper { max-width: 900px; margin: 40px auto; padding: 0 20px; }

        .page-header { margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 700; color: #114d4d; }
        .page-header p { color: #777; font-size: 14px; margin-top: 4px; }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .empty-state .icon { font-size: 60px; margin-bottom: 16px; }
        .empty-state h3 { color: #114d4d; font-size: 20px; margin-bottom: 8px; }
        .empty-state p { color: #888; font-size: 14px; margin-bottom: 24px; }
        .btn-cari {
            display: inline-block;
            background: #e65c00;
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }
        .btn-cari:hover { background: #c94f00; }

        .pesanan-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-left: 4px solid #114d4d;
            transition: transform 0.2s;
        }
        .pesanan-card:hover { transform: translateY(-2px); }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        .card-header h3 { font-size: 18px; color: #1a1a1a; font-weight: 600; }
        .card-header .tanggal { font-size: 12px; color: #aaa; margin-top: 4px; }

        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }
        .badge-menunggu { background: #fff3e0; color: #e65c00; }
        .badge-proses   { background: #e3f2fd; color: #1565c0; }
        .badge-selesai  { background: #e8f5e9; color: #2e7d32; }
        .badge-batal    { background: #fce4ec; color: #c62828; }

        .card-body { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 16px; }
        .info-item label { font-size: 11px; color: #999; text-transform: uppercase; letter-spacing: 0.05em; }
        .info-item span { display: block; font-size: 14px; font-weight: 600; color: #333; margin-top: 2px; }

        .detail-pekerjaan {
            background: #f8fafa;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            color: #555;
            margin-bottom: 16px;
            border-left: 3px solid #e0efef;
        }
        .detail-pekerjaan strong { display: block; font-size: 11px; color: #999; margin-bottom: 4px; text-transform: uppercase; }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
        }
        .total { font-size: 18px; font-weight: 700; color: #114d4d; }
        .total small { font-size: 12px; color: #999; font-weight: 400; display: block; }

        .btn-tagihan {
            background: #114d4d;
            color: white;
            padding: 10px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .btn-tagihan:hover { background: #0a3535; }
        .btn-tagihan.disabled {
            background: #ccc;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('home') }}" class="logo">🦸 KerjainAja</a>
    <a href="{{ route('home') }}" class="back">← Kembali ke Beranda</a>
</nav>

<div class="page-wrapper">
    <div class="page-header">
        <h1>📋 Pesanan Saya</h1>
        <p>Riwayat semua pesanan jasa yang telah kamu buat</p>
    </div>

    @if($pesanan->isEmpty())
        <div class="empty-state">
            <div class="icon">📭</div>
            <h3>Belum Ada Pesanan</h3>
            <p>Kamu belum pernah memesan jasa. Yuk cari mitra terbaik sekarang!</p>
            <a href="{{ route('pencarian') }}" class="btn-cari">Cari Jasa Sekarang</a>
        </div>
    @else
        @foreach($pesanan as $p)
        <div class="pesanan-card">
            <div class="card-header">
                <div>
                    <h3>{{ $p->nama_pekerja }}</h3>
                    <div class="tanggal">📅 {{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y, H:i') }}</div>
                </div>
                <span class="badge
                    @if($p->status == 'Menunggu Pembayaran') badge-menunggu
                    @elseif($p->status == 'Proses Verifikasi') badge-proses
                    @elseif($p->status == 'Selesai') badge-selesai
                    @else badge-batal @endif">
                    {{ $p->status }}
                </span>
            </div>

            <div class="card-body">
                <div class="info-item">
                    <label>Durasi</label>
                    <span>⏱ {{ $p->durasi }}</span>
                </div>
                <div class="info-item">
                    <label>Pembayaran</label>
                    <span>💳 {{ $p->metode_pembayaran }}</span>
                </div>
                <div class="info-item">
                    <label>No. Pesanan</label>
                    <span>#{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            @if($p->detail_pekerjaan)
            <div class="detail-pekerjaan">
                <strong>Detail Pekerjaan</strong>
                {{ $p->detail_pekerjaan }}
            </div>
            @endif

            <div class="card-footer">
                <div class="total">
                    <small>Total Tagihan</small>
                    Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}
                </div>
                @if($p->status == 'Menunggu Pembayaran')
                    <a href="{{ route('tagihan', $p->id) }}" class="btn-tagihan">Lihat Tagihan →</a>
                @else
                    <span class="btn-tagihan disabled">{{ $p->status }}</span>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</div>

</body>
</html>