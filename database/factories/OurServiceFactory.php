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
        $pathIcon = 'our-service/';
        return [
            'icon' => $this->faker->unique(true)->randomElement([
                Storage::url($pathIcon . 'service1.svg'), 
                Storage::url($pathIcon . 'service2.svg'),
                Storage::url($pathIcon . 'service3.svg'), 
                Storage::url($pathIcon . 'service4.svg')
            ]),
            'title' => $this->faker->word(2),
            'desc' => $this->faker->sentence(4)
        ];
    }
}
