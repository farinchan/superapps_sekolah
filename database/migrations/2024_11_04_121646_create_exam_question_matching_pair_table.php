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
        Schema::create('exam_question_matching_pair', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_question_id')->constrained('exam_question')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pair_text');
            $table->string('pair_image')->nullable();
            $table->string('pair_match');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_question_matching_pairs');
    }
};
