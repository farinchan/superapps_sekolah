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
        Schema::create('ppdb_exam_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_exam_id')->constrained('ppdb_exam')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_exam_schedule');
    }
};
