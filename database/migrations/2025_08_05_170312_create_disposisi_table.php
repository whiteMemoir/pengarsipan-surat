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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_surat');
            $table->integer('kepada');
            $table->integer('oleh');
            $table->text('isi_disposisi');
            $table->enum('status_disposisi', ['belum', 'sudah'])->default('belum');
            $table->timestamp('waktu_disposisi')->nullable();
            $table->timestamp('waktu_dibaca')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
