<?php

namespace Database\Factories;

use App\Models\OurService;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $pathIcon = 'uploaded/dummy/our-service/';
        return [
            'icon' => $this->faker->unique(true)->randomElement([
                $pathIcon . 'service1.svg', 
                $pathIcon . 'service2.svg',
                $pathIcon . 'service3.svg', 
                $pathIcon . 'service4.svg'
            ]),
            'title' => $this->faker->word(2),
            'desc' => $this->faker->sentence(4)
        ];
    }
}
