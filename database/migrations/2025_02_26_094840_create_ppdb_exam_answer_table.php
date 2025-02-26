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
        Schema::create('ppdb_exam_answer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_exam_session_id')->constrained('ppdb_exam_session')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ppdb_exam_question_id')->constrained('ppdb_exam_question')->onDelete('cascade')->onUpdate('cascade');
            $table->json('answer')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->float('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_exam_answer');
    }
};
