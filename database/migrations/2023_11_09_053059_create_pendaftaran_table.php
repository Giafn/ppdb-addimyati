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
            $table->bigInteger('ref_voucher_id');
            $table->integer('status_pendaftaran');//(1 = pendaftaran awal, 2 = pembayaran, 3 = pelengkapan_ data, 4 = selesai)
            $table->integer('status_pembayaran');
            $table->bigInteger('nominal_pembayaran_id');
            $table->bigInteger('total_nominal');
            $table->string('bukti_bayar_path');
            $table->bigInteger('referer_id');
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
