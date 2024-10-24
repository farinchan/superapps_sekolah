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
        Schema::create('teacher_achievement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teacher')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_achievements');
    }
};
