<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
            [
                'name_en'    => 'Biography',
                'name_ru'    => 'Биография',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Children’s Books',
                'name_ru'    => 'Детские книги',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Classics',
                'name_ru'    => 'Классика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Comics',
                'name_ru'    => 'Комиксы',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Cookbooks',
                'name_ru'    => 'Кулинарные книги',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Crime',
                'name_ru'    => 'Преступление',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Drama',
                'name_ru'    => 'Драма',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Dystopia',
                'name_ru'    => 'Дистопия',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Fantasy',
                'name_ru'    => 'Фэнтези',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Fiction',
                'name_ru'    => 'Художественная литература',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Graphic Novels',
                'name_ru'    => 'Графические романы',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Health',
                'name_ru'    => 'Здоровье',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Historical Fiction',
                'name_ru'    => 'Историческая фантастика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Horror',
                'name_ru'    => 'Ужасы',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Humor',
                'name_ru'    => 'Юмор',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Law',
                'name_ru'    => 'Право',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Literary Fiction',
                'name_ru'    => 'Литературная фантастика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Memoir',
                'name_ru'    => 'Мемуары',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Mystery',
                'name_ru'    => 'Мистика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Non-fiction',
                'name_ru'    => 'Нехудожественная литература',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Philosophy',
                'name_ru'    => 'Философия',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Poetry',
                'name_ru'    => 'Поэзия',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Politics',
                'name_ru'    => 'Политика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Psychology',
                'name_ru'    => 'Психология',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Religion',
                'name_ru'    => 'Религия',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Romance',
                'name_ru'    => 'Романтика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Science',
                'name_ru'    => 'Наука',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Science Fiction',
                'name_ru'    => 'Научная фантастика',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Self-help',
                'name_ru'    => 'Саморазвитие',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Short Stories',
                'name_ru'    => 'Короткие рассказы',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Sports',
                'name_ru'    => 'Спорт',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Thriller',
                'name_ru'    => 'Триллер',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Travel',
                'name_ru'    => 'Путешествия',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'True Crime',
                'name_ru'    => 'Реальные преступления',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Young Adult',
                'name_ru'    => 'Молодежная литература',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Adventure Fiction',
                'name_ru'    => 'Приключенческая литература',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Alternate History',
                'name_ru'    => 'Альтернативная история',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Art History',
                'name_ru'    => 'История искусства',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Audiobooks',
                'name_ru'    => 'Аудиокниги',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Biography of Famous People',
                'name_ru'    => 'Биография знаменитых людей',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Children’s Non-fiction',
                'name_ru'    => 'Детская научно-популярная литература',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Contemporary Fiction',
                'name_ru'    => 'Современная литература',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Cyberpunk',
                'name_ru'    => 'Киберпанк',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Cooking for Beginners',
                'name_ru'    => 'Кулинария для начинающих',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Crime Thriller',
                'name_ru'    => 'Криминальный триллер',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Dark Fantasy',
                'name_ru'    => 'Тёмное фэнтези',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Espionage',
                'name_ru'    => 'Шпионские романы',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Family Saga',
                'name_ru'    => 'Сага о семье',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Feminism',
                'name_ru'    => 'Феминизм',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Financial Literacy',
                'name_ru'    => 'Финансовая грамотность',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('categories')->insert($data);

    }
}
