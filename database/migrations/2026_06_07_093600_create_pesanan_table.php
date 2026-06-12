<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel pesanan untuk menampung data transaksi antara pencari jasa dan mitra
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('mitra_id')->nullable();
            $table->string('nama_pekerja', 100);
            $table->string('durasi', 50);
            $table->string('metode_pembayaran', 50);
            $table->integer('total_tagihan');
            $table->text('detail_pekerjaan')->nullable();
            $table->enum('status', ['Menunggu Pembayaran', 'Proses Verifikasi', 'Selesai', 'Dibatalkan'])->default('Menunggu Pembayaran');
            $table->timestamp('tanggal_pesan')->useCurrent();
        });
    }

    public function down(): void
    {
        // Menghapus tabel pesanan saat melakukan rollback migration
        Schema::dropIfExists('pesanan');
    }
};