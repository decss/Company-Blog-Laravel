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
                'parent_id' => 0,
                'title' => 'Блог',
                'alias' => 'blog',
            ], [
                'parent_id' => 1,
                'title' => 'Компьютеры',
                'alias' => 'computers',
            ], [
                'parent_id' => 1,
                'title' => 'Интересное',
                'alias' => 'iteresting',
            ], [
                'parent_id' => 1,
                'title' => 'Советы',
                'alias' => 'soveti',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
