@extends('admin.layout')

@section('content')

<div class="page-header">
    <h1>📋 Kelola Pesanan</h1>
</div>

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
                <td>
                    <span class="badge badge-warning">{{ $p->status }}</span>
                </td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;">Belum ada pesanan</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrapper">{{ $pesanans->links() }}</div>
</div>

@endsection