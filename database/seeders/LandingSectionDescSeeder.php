<?php

namespace Database\Seeders;

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
        LandingSectionDesc::insert([
            [
                'section_name' => 'Tentang Kami',
                'desc' => 'Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet
                veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute
                nulla ipsum velit export irure minim illum fore.',
            ],
            [
                'section_name' => 'Layanan Kami',
                'desc' => ''
            ],
            [
                'section_name' => 'Hubungi Kami',
                'desc' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.',
            ],
            [
                'section_name' => 'Team Kami',
                'desc' => '',
            ],
            [
                'section_name' => 'Tanya Kami',
                'desc' => '',
            ],
            [
                'section_name' => 'Kontak Kami',
                'desc' => '',
            ],
        ]);
    }
}
