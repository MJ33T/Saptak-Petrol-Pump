<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // [
            // 'name' => 'Jeet',
            // 'username' => 'jeet',
            // 'password' => Hash::make('jeet1234'),
            // 'role' => 'admin'

            // ],
            [
                'name' => 'Nahin',
                'username' => 'nahin',
                'password' => Hash::make('admin1234'),
                'role' => 'admin'
            ],
            [
                'name' => 'Rahman',
                'username' => 'rahman',
                'password' => Hash::make('rahman1234'),
                'role' => 'user'
            ],
            [
                'name' => 'User2',
                'username' => 'user2',
                'password' => Hash::make('user5678'),
                'role' => 'user'
            ]
        ]);
    }
}
