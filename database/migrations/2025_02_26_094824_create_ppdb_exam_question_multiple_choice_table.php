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
        Schema::create('ppdb_exam_question_multiple_choice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_exam_question_id')->constrained('ppdb_exam_question')->onDelete('cascade')->onUpdate('cascade');
            $table->text('choice_text')->nullable();
            $table->string('choice_image')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_exam_question_multiple_choice');
    }
};
