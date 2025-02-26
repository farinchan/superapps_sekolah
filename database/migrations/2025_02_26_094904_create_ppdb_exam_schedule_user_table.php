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
        Schema::create('ppdb_exam_schedule_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_exam_schedule_id')->constrained('ppdb_exam_schedule')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ppdb_user_id')->constrained('ppdb_user')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_exam_schedule_user');
    }
};
