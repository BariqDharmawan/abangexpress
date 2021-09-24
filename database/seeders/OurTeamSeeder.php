<?php

namespace Database\Seeders;

use App\Models\OurTeam;
use Illuminate\Database\Seeder;

class OurTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurTeam::factory()->count(6)->create();
    }
}
