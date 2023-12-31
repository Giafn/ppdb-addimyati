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
        Schema::create('akademik', function (Blueprint $table) {
            $table->id();
            $table->string('asal_sekolah');
            $table->string('nomor_seri_sttb')->nullable();
            $table->integer('tahun_sttb')->nullable();
            $table->string('nisn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademik');
    }
};
