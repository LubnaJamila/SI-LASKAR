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
        Schema::create('klastering_hasil_wps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();

            // Hasil clustering
            $table->unsignedTinyInteger('cluster');          // 0,1,2,3
            $table->string('label', 20);                     // Tinggi/Sedang/Rendah/Sangat Rendah

            // Data mentah (untuk tampilan tabel)
            $table->unsignedInteger('total_wps')->default(0);
            $table->unsignedInteger('total_hotspot_dikunjungi')->default(0);
            $table->unsignedInteger('total_tes_wps')->default(0);
            $table->unsignedInteger('total_positif_wps')->default(0);

            // Fitur yang digunakan clustering
            $table->decimal('wps_per_1000_penduduk', 10, 4)->default(0);
            $table->decimal('hotspot_per_1000_penduduk', 10, 4)->default(0);
            $table->decimal('tes_rate', 8, 4)->default(0);
            $table->decimal('positif_rate', 8, 4)->default(0);

            $table->timestamps();

            $table->unique(['periode_id', 'kecamatan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klastering_hasil_wps');
    }
};