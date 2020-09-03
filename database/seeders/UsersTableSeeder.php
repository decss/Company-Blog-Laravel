<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
                'login'     => 'admin',
                'name'      => 'John Doe',
                'email'     => 'test@gmail.com',
                'password'  => bcrypt('test@gmail.com'),
                'created_at' => date('Y-m-d H:i:s'),
            ], [
                'login'     => 'HappyUser',
                'name'      => 'Happy User',
                'email'     => 'happy-user@gmail.com',
                'password'  => bcrypt('happy-user@gmail.com'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
