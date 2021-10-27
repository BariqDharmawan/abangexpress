<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        User::insert([
            [
                'name' => 'Admin Company 1',
                'username' => 'admincompany1',
                'password' => Hash::make('passwordadmin'),
                'plain_password' => md5('passwordadmin'),
                'role' => 'admin',
                'code_api' => 'CAX0139',
                'token_api' => 'a6a78cedf2d91fc0c794adf2aa7237f5',
                'domain_owner' => 'http://127.0.0.1:8000',
                'lt' => 3,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Admin Company 2',
                'username' => 'admincompany2',
                'password' => Hash::make('passwordadmin'),
                'plain_password' => md5('passwordadmin'),
                'role' => 'admin',
                'code_api' => 'CAX0135',
                'token_api' => 'a6a78cedf2d91fc0c794adf2aa7237f5',
                'domain_owner' => 'http://127.0.0.1:9000',
                'lt' => 3,
                'remember_token' => Str::random(10),
            ]
        ]);

        //sub-admin
        User::factory()->count(5)->create();
    }
}
