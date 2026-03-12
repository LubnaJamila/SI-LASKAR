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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rencana_id')->constrained('rencana_kunjungan');
            $table->foreignId('hotspot_id')->constrained();
            $table->foreignId('team_id')->constrained();
            $table->foreignId('periode_id')->constrained();
            $table->foreignId('created_by')->constrained('users');

            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->boolean('waktu_ramai')->default(false)->nullable();

            $table->integer('jumlah_dijangkau')->nullable();
            $table->integer('jumlah_tes')->nullable();
            $table->integer('jumlah_positif')->nullable();
            $table->string('gatekeeper')->nullable();
            
            $table->string('foto')->nullable();
            
            $table->decimal('longitude',10,7)->nullable();
            $table->decimal('latitude',10,7)->nullable();
            
            $table->enum('status_validasi',[
                'menunggu','valid','tidak_valid','perlu_silang'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};