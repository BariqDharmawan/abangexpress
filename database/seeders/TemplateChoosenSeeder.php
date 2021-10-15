<?php

namespace Database\Seeders;

use App\Helper\Helper;
use App\Models\TemplateChoosen;
use Illuminate\Database\Seeder;

class TemplateChoosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templateVersion = [1, 2];

        foreach (Helper::DUMMY_DOMAINS as $key => $domain) {
            TemplateChoosen::create([
                'domain_owner' => $domain,
                'version' => $templateVersion[$key]
            ]);
        }
    }
}
