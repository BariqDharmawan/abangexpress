<?php

namespace Database\Seeders;

use App\Models\OurSocial;
use Illuminate\Database\Seeder;

class OurSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurSocial::factory()->count(10)->create();
    }
}
