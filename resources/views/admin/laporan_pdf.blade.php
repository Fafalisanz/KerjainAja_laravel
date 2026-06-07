<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan - KerjainAja</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #0c4b4a; font-size: 20px; }
        .header p { color: #666; }
        .summary { display: flex; gap: 20px; margin-bottom: 20px; }
        .summary-box { background: #f5f6fa; padding: 15px; border-radius: 8px; flex: 1; }
        .summary-box h3 { font-size: 20px; color: #0c4b4a; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #0c4b4a; color: white; padding: 10px; text-align: left; }
        td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) td { background: #f9f9f9; }
        .footer { margin-top: 30px; text-align: right; color: #888; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KerjainAja - Laporan Pesanan</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($dari)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($sampai)->format('d/m/Y') }}</p>
        <p>Dicetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Pekerja</th>
                <th>Durasi</th>
                <th>Metode</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>#{{ 1000 + $p->id }}</td>
                <td>{{ $p->nama_pekerja }}</td>
                <td>{{ $p->durasi }}</td>
                <td>{{ $p->metode_pembayaran }}</td>
                <td>Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</td>
                <td>{{ $p->status }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align:right; font-weight:bold;">Total Pendapatan:</td>
                <td colspan="3" style="font-weight:bold; color:#0c4b4a;">
                    Rp {{ number_format($summary->total_pendapatan ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Total {{ $pesanans->count() }} pesanan | KerjainAja © {{ now()->year }}
    </div>
</body>
</html>