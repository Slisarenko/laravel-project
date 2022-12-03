<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'USER #1',
                'email' => 'user1@mail.mail',
                'email_verified_at' => '1970-01-01 00:00:00',
                'password' => Hash::make('password'),
                'created_at' => '1970-01-01 00:00:00',
                'updated_at' => '1970-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'name' => 'USER #2',
                'email' => 'user2@mail.mail',
                'email_verified_at' => '1970-02-02 00:00:00',
                'password' => Hash::make('password'),
                'created_at' => '1970-02-02 00:00:00',
                'updated_at' => '1970-02-02 00:00:00',
            ],
            [
                'id' => 3,
                'name' => 'USER #3',
                'email' => 'user3@mail.mail',
                'email_verified_at' => '1970-03-03 00:00:00',
                'password' => Hash::make('password'),
                'created_at' => '1970-03-03 00:00:00',
                'updated_at' => '1970-03-03 00:00:00',
            ]
        ]);
    }
}
