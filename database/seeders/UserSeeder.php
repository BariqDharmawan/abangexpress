<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        // no need to encrypted password again, it already handled on User model
        User::insert([
            [
                'name' => 'Admin 1',
                'username' => 'admin1',
                'password' => 'adminabangexpress'
            ],
            [
                'name' => 'Admin 2',
                'username' => 'admin2',
                'password' => 'adminabangexpress'
            ],
            [
                'name' => 'Admin 3',
                'username' => 'admin3',
                'password' => 'adminabangexpress'
            ],
        ]);
    }
}
