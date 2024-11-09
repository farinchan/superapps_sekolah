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
            $table->json('answer')->nullable();
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

// FORMAT JSON ANSWER
// {
//     "multiple_choice": {
//         "id": 1,
//         "text": "ini adalah jawaban",
//      }
//     "multiple_choice_complex": {[
//         {'id': 1, 'text': 'ini adalah jawaban'},
//         {'id': 2, 'text': 'ini adalah jawaban'},
//         {'id': 3, 'text': 'ini adalah jawaban'},
//     ]}
//     "matching_pair": {[
//         {'left': "ini adalah sisi kiri", 'right': "ini adalah sisi kanan"},
//         {'left': "ini adalah sisi kiri", 'right': "ini adalah sisi kanan"},
//         {'left': "ini adalah sisi kiri", 'right': "ini adalah sisi kanan"},
//     ]}
// }
