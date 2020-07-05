<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
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
                'title' => 'Главная',
                'path'  => 'http://corporate.local',
            ],
            [
                'title' => 'Блог',
                'path'  => 'http://corporate.local/articles',
            ],
            [
                'title' => 'Компьютеры',
                'path'  => 'http://corporate.local/articles/cat/computers',
            ],
            [
                'title' => 'Интересное',
                'path'  => 'http://corporate.local/articles/cat/iteresting',
            ],
            [
                'title' => 'Советы',
                'path'  => 'http://corporate.local/articles/cat/soveti',
            ],
            [
                'title' => 'Портфолио',
                'path'  => 'http://corporate.local/portfolios',
            ],
            [
                'title' => 'Контакты',
                'path'  => 'http://corporate.local/contacts',
            ],
        ];

        DB::table('menus')->insert($data);
    }
}
