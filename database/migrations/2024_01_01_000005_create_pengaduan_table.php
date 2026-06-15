<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->char('id_pengaduan', 15)->primary();
            $table->char('nik', 16);
            $table->char('id_kategori', 3);
            $table->dateTime('tanggal_lapor');
            $table->text('isi_laporan');
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('masyarakat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
