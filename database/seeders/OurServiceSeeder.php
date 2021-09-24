<?php

namespace Database\Seeders;

use App\Models\OurService;
use Illuminate\Database\Seeder;

class OurServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurService::factory()->count(4)->create();
    }
}
