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
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('akademik_id');
            $table->string('nik');
            $table->string('telepon');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->integer('anak_ke');
            $table->integer('jml_saudara_kandung');
            $table->integer('jml_saudara_tiri')->nullable();
            $table->integer('jml_saudara_sekolah')->nullable();
            $table->integer('jml_saudara_no_sekolah')->nullable();
            $table->bigInteger('alamat_id');
            $table->bigInteger('program_keahlian_id');
            $table->string('ukuran_seragam');
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->text('penyakit_kronis')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('hobi')->nullable();
            $table->string('path_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswa');
    }
};
