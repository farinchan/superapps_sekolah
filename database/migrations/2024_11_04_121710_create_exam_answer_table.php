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
        Schema::create('exam_answer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_session_id')->constrained('exam_session')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('exam_question_id')->constrained('exam_question')->onDelete('cascade')->onUpdate('cascade');
            $table->text('answer_text')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_answers');
    }
};
