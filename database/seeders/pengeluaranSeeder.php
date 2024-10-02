<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengeluaran')->insert([
            'keterangan' => 'kalah slot',
            'pengeluaran' => '50000',
            'created_at' => date ('Y-m-d H:i:s')
        ]);
    }
}
