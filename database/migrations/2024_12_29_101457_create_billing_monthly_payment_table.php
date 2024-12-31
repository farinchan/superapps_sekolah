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
        Schema::create('billing_monthly_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_monthly_id')->constrained("billing_monthly")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parent_student_id')->nullable()->constrained("parent_student")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->constrained("student")->onDelete('cascade')->onUpdate('cascade');
            $table->integer('amount');
            $table->integer('payment_month');
            $table->date('payment_date');
            $table->time('payment_time');
            $table->string('image')->nullable();
            $table->enum('status', ['pending', 'paid', 'rejected']);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_monthly_payments');
    }
};
