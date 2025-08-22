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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->string('nopol');
            $table->string('merk')->nullable();
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->string('silinder')->nullable();
            $table->string('warna')->nullable();
            $table->string('rangka');
            $table->string('mesin');
            $table->integer('tahun');
            $table->string('pemilik')->nullable();
            $table->string('jenis_kendaraan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
