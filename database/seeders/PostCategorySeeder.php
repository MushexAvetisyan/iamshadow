<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_en'    => 'Action',
                'name_ru'    => 'Экшн',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Anthology',
                'name_ru'    => 'Антология',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Art',
                'name_ru'    => 'Искусство',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('post_categories')->insert($data);

    }
}
