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
                'name' => 'Company 1',
                'username' => 'admincompany1',
                'password' => Hash::make('admincompany1'),
                'role' => 'admin',
                'domain_owner' => 'http://127.0.0.1:8000'
            ],
            [
                'name' => 'Company 2',
                'username' => 'admincompany2',
                'password' => Hash::make('admincompany2'),
                'role' => 'admin',
                'domain_owner' => 'http://127.0.0.1:9000'
            ],
            [
                'name' => 'Company 3',
                'username' => 'admincompany3',
                'password' => Hash::make('admincompany3'),
                'role' => 'admin',
                'domain_owner' => 'http://127.0.0.1:10000'
            ],
        ]);
    }
}
