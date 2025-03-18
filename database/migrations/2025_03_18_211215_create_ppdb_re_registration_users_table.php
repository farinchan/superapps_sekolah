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
        Schema::create('ppdb_re_registration_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_user_id')->constrained('ppdb_user')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['LULUS/ DITERIMA ASRAMA', 'LULUS/ TIDAK DIASRAMA', 'LULUS PRESTASI/ASRAMA', 'LULUS PRESTASI/TIDAK DIASRAMA', 'CADANGAN', 'TIDAK LULUS'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_re_registration_users');
    }
};
