<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kepada');             // FK ke users (penerima)
            $table->unsignedBigInteger('dibuat_oleh');        // FK ke users (yang input)
            $table->string('no_surat', 30);
            $table->date('tanggal');
            $table->string('perihal', 120);
            $table->string('pengirim', 80);
            $table->text('alamat_pengirim');
            $table->string('file_surat', 120);
            $table->enum('status', ['baru', 'dibaca', 'didisposisi'])->default('baru');
            $table->timestamp('waktu_dibaca')->nullable();
            $table->timestamp('waktu_dibuat')->nullable();
            $table->timestamps();

            // Foreign key relasi ke users
            $table->foreign('kepada')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dibuat_oleh')->references('id')->on('users')->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
