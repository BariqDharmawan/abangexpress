<?php

namespace Database\Seeders;

use App\Models\FirstHeroCarouselLanding;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HeroCarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carousels = ['1.jpg', '2.jpg','3.jpg','4.jpg','5.jpg'];
        $domains = [
            'http://127.0.0.1:8000',
            'http://127.0.0.1:9000', 
            'http://127.0.0.1:10000'
        ];

        foreach ($domains as $key => $domain) {
            foreach ($carousels as $carousel) {
                FirstHeroCarouselLanding::create([
                    'img' => Storage::url('hero-carousel/' . $carousel),
                    'user_id' => $key + 1,
                    'domain_owner' => $domain
                ]);
            }
        }

    }
}
