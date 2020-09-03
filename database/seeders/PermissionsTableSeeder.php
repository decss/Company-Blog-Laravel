<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'VIEW_ADMIN',],
            ['name' => 'ADD_ARTICLES',],
            ['name' => 'UPDATE_ARTICLES',],
            ['name' => 'DELETE_ARTICLES',],
            ['name' => 'VIEW_ADMIN_ARTICLES',],
            ['name' => 'ADMIN_USERS',],
            ['name' => 'EDIT_USERS',],
            ['name' => 'VIEW_ADMIN_MENU',],
            ['name' => 'EDIT_MENU',],
        ];

        DB::table('permissions')->insert($data);
    }
}
