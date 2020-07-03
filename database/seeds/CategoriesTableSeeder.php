<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'title' => 'Блог',
                'alias' => 'blog',
            ], [
                'title' => 'Компьютеры',
                'alias' => 'computers',
            ], [
                'title' => 'Интересное',
                'alias' => 'iteresting',
            ], [
                'title' => 'Советы',
                'alias' => 'soveti',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
