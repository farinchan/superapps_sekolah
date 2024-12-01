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
        Schema::create('exam_question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exam')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('question_type', ['pilihan ganda', 'pilihan ganda kompleks', 'menjodohkan']);
            $table->longText('question_text')->nullable();
            $table->string('question_image')->nullable();
            $table->integer('question_score')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
