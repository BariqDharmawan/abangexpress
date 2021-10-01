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

        foreach ($carousels as $carousel) {
            FirstHeroCarouselLanding::create([
                'img' => Storage::url('hero-carousel/' . $carousel)
            ]);
        }
    }
}
