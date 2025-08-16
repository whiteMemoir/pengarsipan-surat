<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bagian')->insert([
            'nama_bagian' => 'Keuangan',
        ]);

        DB::table('bagian')->insert([
            'nama_bagian' => 'IT',
        ]);
    }
}
