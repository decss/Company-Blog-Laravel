<?php

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
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
                'title' => 'Brand Identity',
                'alias' => 'brand-identity',
            ], [
                'title' => 'Other',
                'alias' => 'other',
            ],
        ];

        DB::table('filters')->insert($data);
    }
}
