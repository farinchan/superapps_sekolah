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
        Schema::create('teacher_attendance_timetable_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained("teacher")->onDelete('cascade');
            $table->foreignId('teacher_attendance_timetable_id')->constrained()->onDelete('cascade')->name('teacher_attendance_timetable_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendance_timetable_teachers');
    }
};
