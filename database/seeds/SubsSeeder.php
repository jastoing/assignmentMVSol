<?php

use Illuminate\Database\Seeder;

class SubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'title' => 'Energy Service 1',
            'desc' => 'This is description for energy service 1',
            'pages' => serialize([
            	['slug'=>'sub1p1', 'title'=>'sub 1 page 1'],
            	['slug'=>'sub1p2', 'title'=>'sub 1 page 2'],
            ]),
        ]);
        DB::table('subscriptions')->insert([
            'title' => 'Energy Service 2',
            'desc' => 'This is description for energy service 2',
            'pages' => serialize([
            	['slug'=>'sub2p1', 'title'=>'sub 2 page 1'],
                ['slug'=>'sub2p2', 'title'=>'sub 2 page 2'],
            ]),
        ]);
        DB::table('subscriptions')->insert([
            'title' => 'Energy Service 3',
            'desc' => 'This is description for energy service 3',
            'pages' => serialize([
            	['slug'=>'sub3p1', 'title'=>'sub 3 page 1'],
                ['slug'=>'sub3p2', 'title'=>'sub 3 page 2'],

            ]),
        ]);
    }
}
