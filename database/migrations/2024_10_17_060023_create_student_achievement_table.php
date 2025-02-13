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
        Schema::create('student_achievement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student')->onDelete('cascade');
            $table->string('name');
            $table->date('date');
            $table->string('level');
            $table->string('event');
            $table->string('rank');
            $table->string('description');
            $table->string('file');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_achievements');
    }
};
