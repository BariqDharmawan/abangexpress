<?php

namespace Database\Seeders;

use App\Helper\Helper;
use App\Models\LandingSectionTitle;
use Illuminate\Database\Seeder;

class LandingSectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Helper::DUMMY_DOMAINS as $domain) {
            LandingSectionTitle::insert([
                'about_us' => "Tentang Kami",
                'our_service' => "Layanan Kami",
                'contact_us' => "Hubungi Kami",
                'our_team' => "Team Kami",
                'our_branch' => "Cabang Kami",
                'faq' => "Tanya Kami",
                'our_contact' => "Kontak Kami",
                "domain_owner" => $domain
            ]);
        }
    }
}
