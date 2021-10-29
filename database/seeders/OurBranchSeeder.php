<?php

namespace Database\Seeders;

use App\Models\OurBranch;
use Illuminate\Database\Seeder;

class OurBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurBranch::factory()->count(3)->create();
    }
}
