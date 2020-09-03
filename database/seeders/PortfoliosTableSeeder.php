<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfoliosTableSeeder extends Seeder
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
                'filter_alias'  => 'brand-identity',
                'title'         => 'Steep This!',
                'alias'         => 'project1',
                'img'           => '{"mini":"0061-175x175.jpg","max":"0061-770x368.jpg","path":"0061.jpg"}',
                'customer'      => 'Samsung',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-01 12:30:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Kineda',
                'alias'         => 'project2',
                'img'           => '{"mini":"009-175x175.jpg","max":"009-770x368.jpg","path":"009.jpg"}',
                'customer'      => 'customer',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-01 12:35:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Love',
                'alias'         => 'project3',
                'img'           => '{"mini":"0011-175x175.jpg","max":"0043-770x368.jpg","path":"0043.jpg"}',
                'customer'      => 'Apple',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-04 00:23:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Guanacos',
                'alias'         => 'project4',
                'img'           => '{"mini":"0027-175x175.jpg","max":"0027-770x368.jpg","path":"0027.jpg"}',
                'customer'      => 'customer',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-04 00:23:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Miller Bob',
                'alias'         => 'project5',
                'img'           => '{"mini":"0071-175x175.jpg","max":"0071-770x368.jpg","path":"0071.jpg"}',
                'customer'      => 'Apple',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-04 00:23:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Nili Studios',
                'alias'         => 'project6',
                'img'           => '{"mini":"0052-175x175.jpg","max":"0052-770x368.jpg","path":"0052.jpg"}',
                'customer'      => '',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-04 00:23:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'VItale Premium',
                'alias'         => 'project7',
                'img'           => '{"mini":"0081-175x175.jpg","max":"0081-770x368.jpg","path":"0081.jpg"}',
                'customer'      => '',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-05 10:00:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Digitpool Medien',
                'alias'         => 'project8',
                'img'           => '{"mini":"0071-175x175.jpg","max":"0071.jpg","path":"0071-770x368.jpg"}',
                'customer'      => 'Samsung',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-05 10:30:00',
            ], [
                'filter_alias'  => 'brand-identity',
                'title'         => 'Octopus',
                'alias'         => 'project9',
                'img'           => '{"mini":"0081-175x175.jpg","max":"0081.jpg","path":"0081-770x368.jpg"}',
                'customer'      => '',
                'text'          => 'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'created_at'    => '2020-07-05 10:30:00',
            ],
        ];

        DB::table('portfolios')->insert($data);
    }
}
