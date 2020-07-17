<?php

use Illuminate\Database\Seeder;

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
                'name'      => 'John Doe',
                'email'     => 'test@gmail.com',
                'password'  => bcrypt('test@gmail.com'),
                'created_at' => date('Y-m-d H:i:s'),
            ], [
                'name'      => 'Happy User',
                'email'     => 'happy-user@gmail.com',
                'password'  => bcrypt('happy-user@gmail.com'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
