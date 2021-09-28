<?php

namespace Database\Factories;

use App\Helper\Helper;
use App\Models\OurSocial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class OurSocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OurSocial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $socialMedia = json_decode(
            file_get_contents(public_path('json/social-media.json')), true
        );

        
        $platform = Arr::pluck($socialMedia, 'platform');
        $platform = $this->faker->randomElement($platform);

        $link = Arr::pluck($socialMedia, 'link');

        $pathIcon = 'uploaded/dummy/our-social/';

        return [
            'icon' => $this->faker->randomElement([
                $pathIcon . 'instagram.svg',
                $pathIcon . 'facebook.svg',
                $pathIcon . 'linkedin.svg',
                $pathIcon . 'twitter.svg',
            ]),
            'platform' => $platform,
            'username' => $this->faker->userName(),
            'link' => $this->faker->randomElement($link)
        ];
    }
}
