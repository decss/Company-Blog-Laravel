<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
