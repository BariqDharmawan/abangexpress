<?php

namespace Database\Seeders;

use App\Helper\Helper;
use App\Models\PositionList;
use Illuminate\Database\Seeder;

class PositionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = ['Entrepeneur', 'Designer', 'CEO & Owner', 'Freelancer'];

        foreach (Helper::DUMMY_DOMAINS as $key => $domain) {
            foreach ($lists as $list) {
                PositionList::create([
                    'name' => $list,
                    'domain_owner' => $domain
                ]);
            }
        }
    }
}
