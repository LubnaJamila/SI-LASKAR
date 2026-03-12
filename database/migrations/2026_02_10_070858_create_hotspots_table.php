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
        Schema::create('hotspots', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kecamatan_id')->constrained('kecamatan');
            $table->foreignId('team_id')->constrained('teams');
            $table->foreignId('created_by')->constrained('users');

            $table->string('nama_hotspot',150);
            $table->string('jenis_hotspot',100);
            $table->enum('jenis_populasi',['wps','lsl']);

            $table->string('penanggungjawab',150)->nullable();
            $table->string('kontak_penanggungjawab',50)->nullable();

            $table->decimal('longitude',10,7)->nullable();
            $table->decimal('latitude',10,7)->nullable();

            $table->enum('status',['aktif','non-aktif'])->default('aktif');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspots');
    }
};