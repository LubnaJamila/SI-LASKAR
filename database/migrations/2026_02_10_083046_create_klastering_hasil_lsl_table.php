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
        Schema::create('klastering_hasil_lsl', function (Blueprint $table) {
            $table->id();

            $table->foreignId('periode_id')->constrained('periodes');
            $table->foreignId('kecamatan_id')->constrained('kecamatan');

            $table->float('lsl_per_1000');
            $table->float('hotspot_lsl_per_1000');

            $table->integer('cluster_label');
            $table->string('cluster_name',50);

            $table->unique(['periode_id','kecamatan_id']);

            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klastering_hasil_lsl');
    }
};