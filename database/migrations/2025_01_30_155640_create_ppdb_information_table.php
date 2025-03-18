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
        Schema::create('ppdb_information', function (Blueprint $table) {
            $table->id();
            $table->boolean('registration_status')->default(false);
            $table->string('registration_message')->nullable();
            $table->string('login_status')->nullable();
            $table->string('login_message')->nullable();
            $table->longText('information')->nullable();
            $table->string('phone_admin')->nullable();
            $table->longText('re_registration_information')->nullable();
            $table->string('statement_letter')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_information');
    }
};
