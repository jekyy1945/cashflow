<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemasukan')->insert([
            'keterangan' => 'menang slot',
            'pemasukan' => '50000',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
