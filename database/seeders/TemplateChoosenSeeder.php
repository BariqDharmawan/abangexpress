<?php

namespace Database\Seeders;

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
        $domains = ['http://127.0.0.1:8000', 'http://127.0.0.1:9000'];
        $templateVersion = [1, 2];

        foreach ($domains as $key => $domain) {
            TemplateChoosen::create([
                'domain_owner' => $domain,
                'version' => $templateVersion[$key]
            ]);
        }
    }
}
