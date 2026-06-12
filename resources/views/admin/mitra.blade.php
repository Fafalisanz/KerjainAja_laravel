@extends('admin.layout')

@section('content')

{{-- Bagian Atas / Header Halaman Kelola Mitra --}}
<div class="page-header">
    <h1>👥 Kelola Mitra</h1>
</div>

{{-- Komponen Notifikasi Pesan Sukses --}}
@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

{{-- Kontainer Utama Tabel Data Mitra --}}
<div class="card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Keahlian</th>
                <th>Kota</th>
                <th>No WA</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mitras as $i => $m)
                <tr>
                    <td>{{ $mitras->firstItem() + $i }}</td>
                    <td>{{ $m->nama_lengkap }}</td>
                    <td>{{ $m->keahlian }}</td>
                    <td>{{ $m->kota }}</td>
                    <td>{{ $m->no_wa }}</td>
                    <td>{{ \Carbon\Carbon::parse($m->tanggal_daftar)->format('d/m/Y') }}</td>
                    
                    {{-- Kondisi Penentuan Label Status Pendaftaran Mitra --}}
                    <td>
                        @if(isset($m->status) && $m->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif(isset($m->status) && $m->status == 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    
                    {{-- Blok Tombol Aksi Persetujuan / Penolakan Berkas --}}
                    <td style="display:flex; gap:8px;">
                        <form action="{{ route('admin.mitra.approve', $m->id) }}" method="POST">
                            @csrf 
                            @method('PUT')
                            <button class="btn btn-success">✅ Approve</button>
                        </form>
                        <form action="{{ route('admin.mitra.reject', $m->id) }}" method="POST">
                            @csrf 
                            @method('PUT')
                            <button class="btn btn-danger">❌ Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">Belum ada mitra</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    {{-- Komponen Navigasi Paginasi Halaman --}}
    <div class="pagination-wrapper">
        {{ $mitras->links() }}
    </div>
</div>

@endsection