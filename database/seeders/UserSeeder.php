<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('superadmin123'),
            'level_user' => 'super_admin',
            'status' => 'aktif',
        ]);

        DB::table('users')->insert([
            'nama' => 'Admin',
            'email' => 'admin@mail.com',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'level_user' => 'admin',
            'id_bagian' => 1,
            'status' => 'aktif',
        ]);

        DB::table('users')->insert([
            'nama' => 'Kepala Bagian',
            'email' => 'kepala@mail.com',
            'username' => 'kepala',
            'password' => bcrypt('kepala123'),
            'level_user' => 'kepala_bagian',
            'id_bagian' => 1,
            'status' => 'aktif',
        ]);
    }
}


// Schema::create('users', function (Blueprint $table) {
//             $table->id();
//             $table->string('email')->unique();
//             $table->timestamp('email_verified_at')->nullable();
//             $table->string('password');
//             $table->rememberToken();
//             $table->timestamps();
//         });

//         Schema::create('password_reset_tokens', function (Blueprint $table) {
//             $table->string('email')->primary();
//             $table->string('token');
//             $table->timestamp('created_at')->nullable();
//         });

//         Schema::create('sessions', function (Blueprint $table) {
//             $table->string('id')->primary();
//             $table->foreignId('user_id')->nullable()->index();
//             $table->string('ip_address', 45)->nullable();
//             $table->text('user_agent')->nullable();
//             $table->longText('payload');
//             $table->integer('last_activity')->index();
//         });


// Schema::table('users', function (Blueprint $table) {
//             $table->string('nama', 80)->after('id');
//             $table->enum('level_user', ['super_admin', 'admin', 'kepala_bagian'])->after('nama');
//             $table->unsignedBigInteger('id_bagian')->nullable()->after('level_user');
//             $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('id_bagian');

//             $table->foreign('id_bagian')->references('id')->on('bagian')->nullOnDelete();
//         });
