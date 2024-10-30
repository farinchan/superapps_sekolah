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
        Schema::create('discipline_rule', function (Blueprint $table) {
            $table->id();
            $table->string('rule');
            $table->text('description');
            $table->enum('category', ['ringan', 'sedang', 'berat', 'sangat berat'])->nullable();
            $table->integer('point');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_rules');
    }
};
