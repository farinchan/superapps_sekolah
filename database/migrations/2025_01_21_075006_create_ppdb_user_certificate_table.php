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
        Schema::create('ppdb_user_certificate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_user_id')->constrained('ppdb_user')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('rank')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_user_certificates');
    }
};
