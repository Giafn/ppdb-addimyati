<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ppdb_id');
            $table->string('kode');
            $table->bigInteger('calon_siswa_id');
            $table->bigInteger('status_pendaftaran');//(1 = belum lengkap, 2 = sudah lengkap)
            $table->bigInteger('status_pembayaran');//(1 = belum bayar, 2 = belum lunas, 3 = lunas)
            $table->string('referensi')->nullable();
            $table->bigInteger('jurusan_id1');
            $table->bigInteger('jurusan_id2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
