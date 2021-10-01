<?php

namespace Database\Factories;

use App\Helper\Helper;
use App\Models\OurSocial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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

        $pathIcon = '/storage/our-social/';

        return [
            'icon' => $this->faker->randomElement([
                $pathIcon . 'instagram.svg',
                $pathIcon . 'facebook.svg',
                $pathIcon . 'linkedin.svg',
                $pathIcon . 'twitter.svg',
            ]),
            'platform' => $this->faker->randomElement(Helper::getListSocialPlatform()),
            'username' => $this->faker->userName(),
            'link' => $this->faker->randomElement(Helper::getListSocialLink())
        ];
    }
}
