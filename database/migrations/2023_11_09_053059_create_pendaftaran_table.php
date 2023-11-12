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
            $table->bigInteger('ref_voucher_id')->nullable();
            $table->integer('status_pendaftaran');//(1 = belum lengkap, 2 = sudah lengkap)
            $table->integer('status_pembayaran');//(1 = belum bayar, 2 = belum lunas, 3 = lunas)
            $table->bigInteger('nominal_pembayaran')->nullable();
            $table->bigInteger('total_nominal')->nullable();
            $table->string('bukti_bayar_path')->nullable();
            $table->bigInteger('referer_id')->nullable();
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
