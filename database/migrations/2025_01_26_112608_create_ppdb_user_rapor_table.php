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
        Schema::create('ppdb_user_rapor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_user_id')->constrained('ppdb_user')->onDelete('cascade');
            $table->enum('rapor_type', ['SMP', 'MTS'])->nullable();
            $table->json('semester1_nilai')->nullable();
            $table->string('semester1_file')->nullable();
            $table->json('semester2_nilai')->nullable();
            $table->string('semester2_file')->nullable();
            $table->json('semester3_nilai')->nullable();
            $table->string('semester3_file')->nullable();
            $table->json('semester4_nilai')->nullable();
            $table->string('semester4_file')->nullable();
            $table->json('semester5_nilai')->nullable();
            $table->string('semester5_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_user_rapors');
    }
};
