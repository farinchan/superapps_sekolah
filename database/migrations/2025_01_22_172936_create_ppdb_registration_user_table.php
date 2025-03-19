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
        Schema::create('ppdb_registration_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_path_id')->constrained('ppdb_path')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ppdb_user_id')->constrained('ppdb_user')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status_berkas', ['sedang diverifikasi', 'diterima', 'ditolak', 'perbaiki'])->default('sedang diverifikasi');
            $table->enum('status_kelulusan', ['-' ,'LULUS/ DITERIMA ASRAMA', 'LULUS/ TIDAK DIASRAMA', 'LULUS PRESTASI/ASRAMA', 'LULUS PRESTASI/TIDAK DIASRAMA', 'CADANGAN', 'TIDAK LULUS', 'LULUS MADRASAH DAN DITERIMA DI ASRAMA', 'LULUS MADRASAH DAN TIDAK DITERIMA DI ASRAMA', 'LULUS PRESTASI MADRASAH DAN DITERIMA DI ASRAMA', 'LULUS PRESTASI MADRASAH DAN TIDAK DITERIMA DI ASRAMA'])->default('-');
            $table->text('reason')->nullable();
            $table->string('statement_letter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registration_user');
    }
};
