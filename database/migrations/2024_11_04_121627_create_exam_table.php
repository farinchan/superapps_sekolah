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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subject')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->integer('duration');
            $table->foreignId('teacher_id')->constrained('teacher')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type', ['UH', 'UTS', 'UAS', 'UAM']);
            $table->foreignId('school_year_id')->constrained('school_year')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
