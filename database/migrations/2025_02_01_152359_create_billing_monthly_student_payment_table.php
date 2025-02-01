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
        Schema::create('billing_monthly_student_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_monthly_id')->constrained("billing_monthly")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->constrained("student")->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('first_month')->default(false);
            $table->boolean('second_month')->default(false);
            $table->boolean('third_month')->default(false);
            $table->boolean('fourth_month')->default(false);
            $table->boolean('fifth_month')->default(false);
            $table->boolean('sixth_month')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_monthly_student_payments');
    }
};
