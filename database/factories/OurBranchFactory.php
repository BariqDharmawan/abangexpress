<?php

namespace Database\Factories;

use App\Helper\Helper;
use App\Models\OurBranch;
use Illuminate\Database\Eloquent\Factories\Factory;

class OurBranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OurBranch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'icon' => $this->faker->unique(true)->randomElement([
                'storage/branch/google.png',
                'storage/branch/microsoft.png',
                'storage/branch/apple.png'
            ]),
            'telephone' => '8777140665' . $this->faker->numberBetween(1, 9),
            'address' => $this->faker->address(),
            'domain_owner' => $this->faker->randomElement(Helper::DUMMY_DOMAINS)
        ];
    }
}
