@extends('admin.layout')

@section('content')

<div class="page-header">
    <h1>📄 Laporan Dinamis</h1>
</div>

{{-- Filter --}}
<div class="card">
    <form action="{{ route('admin.laporan') }}" method="GET" class="filter-form">
        <div>
            <label style="font-size:13px; color:#666;">Dari Tanggal</label><br>
            <input type="date" name="dari" value="{{ $dari }}">
        </div>
        <div>
            <label style="font-size:13px; color:#666;">Sampai Tanggal</label><br>
            <input type="date" name="sampai" value="{{ $sampai }}">
        </div>
        <div>
            <label style="font-size:13px; color:#666;">Status</label><br>
            <select name="status">
                <option value="semua" {{ $status == 'semua' ? 'selected' : '' }}>Semua</option>
                <option value="Menunggu Pembayaran" {{ $status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="Selesai" {{ $status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div style="align-self:flex-end;">
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
        </div>
        <div style="align-self:flex-end;">
            <a href="{{ route('admin.laporan.pdf', ['dari' => $dari, 'sampai' => $sampai, 'status' => $status]) }}" 
               class="btn btn-orange">⬇️ Export PDF</a>
        </div>
    </form>
</div>

{{-- Summary --}}
<div class="stats-grid" style="grid-template-columns: repeat(2, 1fr);">
    <div class="stat-card">
        <div class="icon">📋</div>
        <h3>{{ $summary->total_pesanan ?? 0 }}</h3>
        <p>Total Pesanan</p>
    </div>
    <div class="stat-card">
        <div class="icon">💰</div>
        <h3>Rp {{ number_format($summary->total_pendapatan ?? 0, 0, ',', '.') }}</h3>
        <p>Total Pendapatan</p>
    </div>
</div>

{{-- Tabel --}}
<div class="card">
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
            @forelse($pesanans as $i => $p)
            <tr>
                <td>{{ $pesanans->firstItem() + $i }}</td>
                <td>#{{ 1000 + $p->id }}</td>
                <td>{{ $p->nama_pekerja }}</td>
                <td>{{ $p->durasi }}</td>
                <td>{{ $p->metode_pembayaran }}</td>
                <td>Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</td>
                <td><span class="badge badge-warning">{{ $p->status }}</span></td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrapper">{{ $pesanans->links() }}</div>
</div>

@endsection