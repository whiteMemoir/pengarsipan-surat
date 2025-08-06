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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama', 80)->after('id');
            $table->enum('level_user', ['super_admin', 'admin', 'kepala_bagian'])->after('nama');
            $table->unsignedBigInteger('id_bagian')->nullable()->after('level_user');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('id_bagian');

            $table->foreign('id_bagian')->references('id')->on('bagian')->nullOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_bagian']);
            $table->dropColumn(['nama', 'level_user', 'id_bagian', 'status']);
        });
    }
};
