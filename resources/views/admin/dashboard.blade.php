@extends('admin.layout')

@section('content')

<div class="page-header">
    <h1>📊 Dashboard Admin</h1>
    <span style="color:#888; font-size:14px;">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
</div>

{{-- Statistik --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="icon">👥</div>
        <h3>{{ $stats['total_mitra'] }}</h3>
        <p>Total Mitra</p>
    </div>
    <div class="stat-card">
        <div class="icon">📋</div>
        <h3>{{ $stats['total_pesanan'] }}</h3>
        <p>Total Pesanan</p>
    </div>
    <div class="stat-card">
        <div class="icon">👤</div>
        <h3>{{ $stats['total_users'] }}</h3>
        <p>Pencari Jasa</p>
    </div>
    <div class="stat-card">
        <div class="icon">⏳</div>
        <h3>{{ $stats['pending'] }}</h3>
        <p>Menunggu Pembayaran</p>
    </div>
</div>

{{-- Grafik --}}
<div class="card">
    <h3>📈 Pesanan 7 Hari Terakhir</h3>
    <canvas id="grafikPesanan" height="80"></canvas>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:25px;">

    {{-- Pesanan Terbaru --}}
    <div class="card">
        <h3>📋 Pesanan Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Pekerja</th>
                    <th>Durasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanan_terbaru as $p)
                <tr>
                    <td>{{ $p->nama_pekerja }}</td>
                    <td>{{ $p->durasi }}</td>
                    <td>
                        <span class="badge badge-warning">{{ $p->status }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;">Belum ada pesanan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mitra Terbaru --}}
    <div class="card">
        <h3>👥 Mitra Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Keahlian</th>
                    <th>Kota</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mitra_terbaru as $m)
                <tr>
                    <td>{{ $m->nama_lengkap }}</td>
                    <td>{{ $m->keahlian }}</td>
                    <td>{{ $m->kota }}</td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;">Belum ada mitra</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($grafik->pluck('tanggal'));
    const data   = @json($grafik->pluck('total'));
</script>
<script src="{{ asset('js/script_admin.js') }}"></script>
@endsection