<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique(); // NIK untuk masyarakat, id_petugas untuk petugas, 'admin' untuk admin
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->enum('role', ['masyarakat', 'petugas', 'admin'])->default('masyarakat');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
