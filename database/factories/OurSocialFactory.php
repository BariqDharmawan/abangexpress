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
        return [
            'icon' => $this->faker->randomElement([
                "fab fa-instagram",
                "fab fa-facebook-square",
                "fab fa-linkedin",
                "fab fa-twitter",
            ]),
            'platform' => $this->faker->randomElement(Helper::getListSocialPlatform()),
            'username' => $this->faker->userName(),
            'link' => $this->faker->randomElement(Helper::getListSocialLink()),
            'user_id' => 1
        ];
    }
}
