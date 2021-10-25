<?php

namespace Database\Factories;

use App\Models\OurContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class OurContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OurContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address(),
            'telephone' => str_replace(' ', '', $this->faker->phoneNumber()),
            'email' => $this->faker->safeEmail(),
            'link_address' => $this->faker->unique(true)->randomElement([
                'https://goo.gl/maps/sqCg6dKMqWF4M2ZD8',
                'https://goo.gl/maps/H5LEXoaPtbQRi7xe8',
                'https://goo.gl/maps/wYzL5S4EdiaM5Mt99'
            ]),
            'domain_owner' => $this->faker->unique()->randomElement([
                'http://127.0.0.1:8000',
                'http://127.0.0.1:9000'
            ])
        ];
    }
}
