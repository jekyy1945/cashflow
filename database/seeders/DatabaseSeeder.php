<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      User::insert([
            'role' => 'user',
            'name' => 'kakak',
            'password' => bcrypt('11'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
