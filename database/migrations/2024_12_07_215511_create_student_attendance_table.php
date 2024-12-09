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
        Schema::create('student_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained("student")->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->time('time_in');
            $table->string('time_in_info')->nullable();
            $table->time('time_out')->nullable();
            $table->string('time_out_info')->nullable();
            $table->foreignId('teacher_id')->constrained("teacher")->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendance');
    }
};
