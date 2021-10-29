<?php

namespace Database\Factories;

use App\Helper\Helper;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img' => $this->faker->unique(true)->randomElement([
                'storage/gallery/1.jpg', 'storage/gallery/2.jpg'
            ]),
            'youtube' => $this->faker->unique(true)->randomElement([
                'https://www.youtube.com/watch?v=WgU7P6o-GkM',
                'https://www.youtube.com/watch?v=x_me3xsvDgk'
            ]),
            'domain_owner' => $this->faker->randomElement(Helper::DUMMY_DOMAINS)
        ];
    }
}
