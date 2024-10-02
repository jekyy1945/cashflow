<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi')->insert([
            'tipe' => 'pemasukan',
            'nominal' => 5000,
            'keterangan' => 'dapat LC',
            'created_at' =>  date('Y-m-d H:i:s')
        ]);
    }
}
