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
        Schema::create('klastering_agregat_lsl', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periode_id')->constrained('periodes');
            $table->foreignId('kecamatan_id')->constrained('kecamatan');

            $table->integer('total_lsl')->default(0);
            $table->integer('total_hotspot_lsl')->default(0);
            $table->integer('total_tes_lsl')->default(0);
            $table->integer('total_positif_lsl')->default(0);

            $table->unique(['periode_id','kecamatan_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klastering_agregat_lsl');
    }
};