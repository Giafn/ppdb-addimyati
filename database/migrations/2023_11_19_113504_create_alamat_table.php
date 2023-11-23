<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('desa');
            $table->string('rt');
            $table->string('rw');
            $table->string('jalan');
            $table->string('gang')->nullable();
            $table->string('no_rumah')->nullable();
            $table->string('kode_pos');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat');
    }
};
