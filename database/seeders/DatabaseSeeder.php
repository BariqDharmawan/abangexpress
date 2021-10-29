<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            HeroCarouselSeeder::class,
            AboutUsSeeder::class,
            OurServiceSeeder::class,
            PositionListSeeder::class,
            OurTeamSeeder::class,
            FaqSeeder::class,
            OurBranchSeeder::class,
            OurContactSeeder::class,
            LandingSectionDescSeeder::class,
            OurSocialSeeder::class,
            TemplateChoosenSeeder::class,
            GallerySeeder::class
        ]);
    }
}
