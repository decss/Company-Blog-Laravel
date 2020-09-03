<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
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
                'user_id' => 1,
                'article_id' => 1,
                'parent_id' => 0,
                'name' => 'Anna',
                'email' => 'anna@gmail.com',
                'site' => 'anna-blog.com',
                'text' => 'Коммента́рий (лат. commentārius — заметки, записки; толкование) — пояснения к тексту, рассуждения, замечания о чём-нибудь или в Интернете — к посту (сообщению).',
                'created_at' => '2020-07-16 15:00:00'
            ], [
                'user_id' => 1,
                'article_id' => 1,
                'parent_id' => 0,
                'name' => '',
                'email' => '',
                'site' => '',
                'text' => 'Пушкина «Евгений Онегин». Мы не могли обойти вниманием такое важное событие и наши юристы подготовили квалифицированные комментарии ',
                'created_at' => '2020-07-16 15:00:00'
            ], [
                'user_id' => 2,
                'article_id' => 1,
                'parent_id' => 1,
                'name' => 'User',
                'email' => '',
                'site' => '',
                'text' => 'Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem. Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem.',
                'created_at' => '2020-07-16 15:00:00'
            ], [
                'user_id' => 1,
                'article_id' => 1,
                'parent_id' => 3,
                'name' => '',
                'email' => '',
                'site' => '',
                'text' => 'Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem. Fusce rutrum lectus id nibh ullamcorper aliquet. ',
                'created_at' => '2020-07-16 15:00:00'
            ], [
                'user_id' => 1,
                'article_id' => 1,
                'parent_id' => 0,
                'name' => 'Anna',
                'email' => 'anna@gmail.com',
                'site' => 'anna-blog.com',
                'text' => 'Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem.',
                'created_at' => '2020-07-16 15:00:00'
            ], [
                'user_id' => 2,
                'article_id' => 1,
                'parent_id' => 2,
                'name' => 'Anna',
                'email' => 'anna@gmail.com',
                'site' => 'anna-blog.com',
                'text' => 'Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem. Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem.',
                'created_at' => '2020-07-16 15:00:00'
            ],
        ];

        DB::table('comments')->insert($data);
    }
}
