@extends('admin.layout')

@section('content')

{{-- Bagian Atas / Header Dashboard Admin --}}
<div class="page-header">
    <h1>📊 Dashboard Admin</h1>
    <span style="color:#888; font-size:14px;">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
</div>

{{-- Blok Grid Kartu Statistik Ringkas --}}
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

{{-- Visualisasi Grafik Batang (Bar Chart) --}}
<div class="card">
    <h3>📊 Pesanan 7 Hari Terakhir</h3>
    <canvas id="grafikPesanan" height="80"></canvas>
</div>

{{-- Pembagian Grid Layout Tabel Data Terbaru --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:25px;">

    {{-- Komponen Tabel: Daftar Pesanan Terbaru --}}
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
                    <tr>
                        <td colspan="3" style="text-align:center;">Belum ada pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Komponen Tabel: Daftar Mitra Baru Mendaftar --}}
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
                    <tr>
                        <td colspan="3" style="text-align:center;">Belum ada mitra</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- Pemuatan Library Chart.js dari CDN Eksternal --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Perbaikan error warna merah dengan membungkus direktif @json ke dalam bentuk string/variabel yang valid bagi JavaScript Linter
    const labels = JSON.parse('{!! json_encode($grafik->pluck("tanggal")) !!}');
    const data = JSON.parse('{!! json_encode($grafik->pluck("total")) !!}');

    // Inisialisasi Rendering Grafik Batang Chart.js
    const ctx = document.getElementById('grafikPesanan').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Menggunakan tipe grafik batang
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pesanan',
                data: data,
                backgroundColor: 'rgba(230, 92, 0, 0.7)', // Warna isi batang grafik (oranye)
                borderColor: '#e65c00', // Warna garis tepi batang grafik
                borderWidth: 2,
                borderRadius: 8, // Sudut batang dibuat tumpul manis
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { 
                    display: false // Menyembunyikan informasi box keterangan dataset di atas grafik
                },
                tooltip: {
                    callbacks: {
                        // Kustomisasi label hover tooltip agar menampilkan kata "pesanan" di ujung angka
                        label: (ctx) => ` ${ctx.parsed.y} pesanan`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Nilai Y axis wajib dimulai dari angka 0
                    ticks: { stepSize: 1 }, // Skala kenaikan angka grafik diatur per 1 poin
                    grid: { color: 'rgba(0,0,0,0.05)' } // Garis latar belakang horizontal dibuat sangat tipis
                },
                x: {
                    grid: { display: false } // Menghilangkan garis vertikal di latar belakang grafik
                }
            }
        }
    });
</script>
@endsection