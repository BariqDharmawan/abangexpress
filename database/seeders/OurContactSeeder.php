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
            'email' => 'info@example.com'
        ]);
    }
}
