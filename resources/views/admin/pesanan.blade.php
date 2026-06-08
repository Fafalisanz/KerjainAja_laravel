@extends('admin.layout')

@section('content')

<div class="page-header">
    <h1>📋 Kelola Pesanan</h1>
</div>

@if(session('success'))
<div style="background:#e8f5e9; color:#2e7d32; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:14px;">
    ✅ {{ session('success') }}
</div>
@endif

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
                <th>Aksi</th>
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
                <td>
                    <span class="badge
                        @if($p->status == 'Menunggu Pembayaran') badge-warning
                        @elseif($p->status == 'Proses Verifikasi') badge-info
                        @elseif($p->status == 'Selesai') badge-success
                        @else badge-danger @endif">
                        {{ $p->status }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d/m/Y') }}</td>
                <td>
                    @if($p->status == 'Proses Verifikasi')
                        <form action="{{ route('admin.pesanan.selesai', $p->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <button type="submit" style="background:#2e7d32; color:white; border:none; padding:5px 10px; border-radius:6px; font-size:12px; cursor:pointer;">
                                ✅ Selesai
                            </button>
                        </form>
                        <form action="{{ route('admin.pesanan.batal', $p->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <button type="submit" style="background:#c62828; color:white; border:none; padding:5px 10px; border-radius:6px; font-size:12px; cursor:pointer;">
                                ❌ Batal
                            </button>
                        </form>
                    @elseif($p->status == 'Selesai')
                        <span style="color:#2e7d32; font-size:12px; font-weight:600;">✅ Selesai</span>
                    @elseif($p->status == 'Dibatalkan')
                        <span style="color:#c62828; font-size:12px; font-weight:600;">❌ Dibatalkan</span>
                    @else
                        <span style="color:#aaa; font-size:12px;">Menunggu konfirmasi</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="9" style="text-align:center;">Belum ada pesanan</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrapper">{{ $pesanans->links() }}</div>
</div>

@endsection