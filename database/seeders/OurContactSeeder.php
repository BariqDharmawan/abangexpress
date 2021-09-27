<?php

namespace Database\Seeders;

use App\Models\OurContact;
use Illuminate\Database\Seeder;

class OurContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurContact::create([
            'address' => 'A108 Adam Street, NY 535022, USA',
            'telephone' => '55895548855',
            'email' => 'info@example.com',
            'link_address' => 'https://goo.gl/maps/sqCg6dKMqWF4M2ZD8'
        ]);
    }
}
