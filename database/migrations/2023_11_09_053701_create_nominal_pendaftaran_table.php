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
        Schema::create('nominal_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tahun_ajaran_id');
            $table->bigInteger('gelombang_id');
            $table->string('nama');
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominal_pendaftaran');
    }
};
