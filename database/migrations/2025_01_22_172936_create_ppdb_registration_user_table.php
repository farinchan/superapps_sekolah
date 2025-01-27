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
            $table->enum('status_berkas', ['sedang diverifikasi', 'diterima', 'ditolak'])->default('sedang diverifikasi');
            $table->enum('status_kelulusan', ['-' ,'lulus', 'tidak lulus'])->default('-');
            $table->text('reason')->nullable();
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
