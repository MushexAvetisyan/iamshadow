<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'en', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Russian', 'code' => 'ru', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Armenian', 'code' => 'hy', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('languages')->insert($languages);
    }
}
