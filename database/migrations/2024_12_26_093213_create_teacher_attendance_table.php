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
        Schema::create('teacher_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained("teacher")->onDelete('cascade');
            $table->foreignId('timetable_id')->nullable()->constrained("teacher_attendance_timetable")->onUpdate('cascade')->onDelete('set null');
            $table->date('date');
            $table->time('time');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
};
