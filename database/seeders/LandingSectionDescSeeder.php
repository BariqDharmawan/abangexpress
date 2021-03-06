<?php

namespace Database\Seeders;

use App\Helper\Helper;
use App\Models\LandingSectionDesc;
use Illuminate\Database\Seeder;

class LandingSectionDescSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Helper::DUMMY_DOMAINS as $key => $domain) {
            LandingSectionDesc::insert([
                [
                    'first_desc_about_us' => 'Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam
                    aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat
                    culpa esse aute nulla ipsum velit export irure minim illum fore.',
                    'second_desc_about_us' => '<p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>',
                    'first_desc_contact_us' => trim('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eufugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officiadeserunt mollit anim id est laborum.'),
                    'domain_owner' => $domain
                ],
                // [
                //     'domain_owner' => $domain,
                //     'section_name' => 'Layanan Kami',
                //     'first_desc' => '',
                //     'second_desc' => ''
                // ],
                // [
                //     'domain_owner' => $domain,
                //     'section_name' => 'Hubungi Kami',
                //     'first_desc' => '',
                //     'second_desc' => ''
                // ],
                // [
                //     'domain_owner' => $domain,
                //     'section_name' => 'Team Kami',
                //     'first_desc' => '',
                //     'second_desc' => ''
                // ],
                // [
                //     'domain_owner' => $domain,
                //     'section_name' => 'Cabang Kami',
                //     'first_desc' => '',
                //     'second_desc' => ''
                // ],
                // [
                //     'domain_owner' => $domain,
                //     'section_name' => 'Tanya Kami',
                //     'first_desc' => '',
                //     'second_desc' => ''
                // ],
                // [
                //     'domain_owner' => $domain,
                //     'section_name' => 'Kontak Kami',
                //     'first_desc' => '',
                //     'second_desc' => ''
                // ],
            ]);
        }
    }
}
