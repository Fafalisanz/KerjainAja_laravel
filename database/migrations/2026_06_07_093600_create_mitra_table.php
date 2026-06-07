<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_lengkap', 100);
            $table->string('no_wa', 20);
            $table->string('kota', 100);
            $table->text('keahlian');
            $table->string('foto_ktp', 255);
            $table->string('foto_selfie', 255);
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->string('status', 20)->default('pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};