<?php

namespace Database\Seeders;

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
        $domains = [
            'http://127.0.0.1:8000',
            'http://127.0.0.1:9000'
        ];

        foreach ($domains as $key => $domain) {
            foreach ($lists as $list) {
                PositionList::create([
                    'name' => $list,
                    'domain_owner' => $domain
                ]);
            }
        }
    }
}
