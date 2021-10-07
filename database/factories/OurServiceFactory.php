<?php

namespace Database\Factories;

use App\Models\OurService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class OurServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OurService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon' => $this->faker->unique(true)->randomElement([
                'fas fa-battery-full', 
                'fab fa-affiliatetheme',
                'fab fa-algolia', 
                'fab fa-amazon-pay'
            ]),
            'title' => $this->faker->word(2),
            'desc' => $this->faker->sentence(4),
            'user_id' => $this->faker->numberBetween(1, 3),
            'domain_owner' => $this->faker->randomElement([
                'http://127.0.0.1:8000',
                'http://127.0.0.1:9000', 
                'http://127.0.0.1:10000'
            ])
        ];
    }
}
