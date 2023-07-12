<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name"    => "Gary",
                "email"   => "asdf@asdf.com",
                "password" => Hash::make('asdfasdf'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}