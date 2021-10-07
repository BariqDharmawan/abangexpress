<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->unique()->sentence(4),
            'answer' => $this->faker->sentence(10),
            'user_id' => $this->faker->unique(true)->numberBetween(1, 3),
            'domain_owner' => $this->faker->randomElement([
                'http://127.0.0.1:8000',
                'http://127.0.0.1:9000', 
                'http://127.0.0.1:10000'
            ])
        ];
    }
}
