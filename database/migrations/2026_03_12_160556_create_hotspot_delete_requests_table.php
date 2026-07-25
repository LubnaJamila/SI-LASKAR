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
        Schema::create('hotspot_delete_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotspot_id')
                  ->constrained('hotspots')
                  ->onDelete('cascade');
            $table->foreignId('requested_by')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->text('alasan_hapus');
            // pending | approved | rejected
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('reviewed_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspot_delete_requests');
    }
};