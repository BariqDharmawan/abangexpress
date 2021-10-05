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
        User::insert([
            [
                'name' => 'Admin 1',
                'username' => 'admin1',
                'password' => Hash::make('adminabangexpress'),
                'role' => 'admin'
            ],
            [
                'name' => 'Admin 2',
                'username' => 'admin2',
                'password' => Hash::make('adminabangexpress'),
                'role' => 'admin'
            ],
            [
                'name' => 'Admin 3',
                'username' => 'admin3',
                'password' => Hash::make('adminabangexpress'),
                'role' => 'admin'
            ],
        ]);
    }
}
