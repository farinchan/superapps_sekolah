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
        Schema::create('ppdb_user', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string("school_origin");
            $table->string('npsn');
            $table->string('whatsapp_number');
            $table->text('address');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('no_kk');
            $table->string('nik');
            $table->string('mother_nik');
            $table->string('mother_name');
            $table->string('mother_phone_number')->nullable();
            $table->string('father_nik');
            $table->string('father_name');
            $table->string('father_phone_number')->nullable();
            $table->string('screenshoot_nisn');
            $table->json('additional_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_users');
    }
};
