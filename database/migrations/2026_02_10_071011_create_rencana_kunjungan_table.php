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
        Schema::create('rencana_kunjungan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hotspot_id')->constrained();
            $table->foreignId('team_id')->constrained();

            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->foreignId('assigned_by')->nullable()->constrained('users');

            $table->foreignId('periode_id')->constrained();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('rencana_kunjungan');

            $table->enum('jenis',['normal','silang'])->default('normal');

            $table->date('tanggal_rencana')->nullable();

            $table->enum('status',[
                'ditugaskan','direncanakan','reschedule','selesai','batal'
            ])->default('ditugaskan');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_kunjungan');
    }
};