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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lengkap',150)->nullable();
            $table->string('nik',50)->nullable();

            $table->enum('jenis_kelamin',['laki-laki','perempuan'])->nullable();
            $table->string('no_telp',20)->nullable();
            $table->text('alamat')->nullable();

            $table->string('email',150)->unique();
            $table->string('password')->nullable();

            $table->enum('role',['admin','petugas'])->default('petugas');
            $table->enum('status',['aktif','non-aktif'])->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};