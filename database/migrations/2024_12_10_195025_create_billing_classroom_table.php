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
        Schema::create('billing_classroom', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_id')->constrained("billing")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classroom_id')->constrained("classroom")->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_classrooms');
    }
};
