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
        Schema::create('ppdb_re_registration_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_user_id')->constrained('ppdb_user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ppdb_registration_user_id')->nullable()->constrained('ppdb_registration_user')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('parent_income')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('file_kip')->nullable();
            $table->string('file_pkh')->nullable();
            $table->string('file_dtks')->nullable();
            $table->string('file_kks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_re_registration_user');
    }
};
