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
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('akademik_id');
            $table->string('nik');
            $table->string('telepon');
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('jenis_kelamin');
            $table->date('ttl');
            $table->string('agama');
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->text('alamat_lengkap');
            $table->bigInteger('program_keahlian_id')->nullable();
            $table->string('ukuran_seragam')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->text('penyakit_kronis')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('keahlian')->nullable();
            $table->bigInteger('file_id')->nullable();
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
