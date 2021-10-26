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
        OurContact::factory()->count(2)->create();
    }
}
