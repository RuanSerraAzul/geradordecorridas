<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name'     => 'seeder for test',
                    'email'    => 'testseeder@fakemail.com',
                ]
                ]);
        DB::table('drivers')->insert(
            [
                [
                    'name'      =>'driver seed for test',
                    'carro'     =>'hyundai veloster',
                ]
            ]
        );

    }
}
