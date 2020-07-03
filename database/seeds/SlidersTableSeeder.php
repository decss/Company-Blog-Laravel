<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
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
                'title' => '<h2 style="color:#fff">CORPORATE, MULTIPURPOSE.. <br /><span>PINK RIO</span></h2>',
                'img'   => 'xx.jpg',
                'desc'  => 'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
            ], [
                'title' => '<h2 style="color:#fff">PINKRIO. <span>STRONG AND POWERFUL.</span></h2>',
                'img'   => '00314.jpg',
                'desc'  => 'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
            ], [
                'title' => '<h2 style="color:#fff">PINKRIO. <span>STRONG AND POWERFUL.</span></h2>',
                'img'   => 'dd.jpg',
                'desc'  => 'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
            ],
        ];

        DB::table('sliders')->insert($data);
    }
}
