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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id('id_insurances');
            $table->unsignedBigInteger('id_kendaraan');

            $table->foreign('id_kendaraan')
                ->references('id_kendaraan')
                ->on('kendaraan')
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('no_polish')->nullable();
            $table->integer('harga')->nullable();
            $table->string('end_insurance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
