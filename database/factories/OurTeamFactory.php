<?php

namespace Database\Factories;

use App\Models\OurTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class OurTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OurTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $avatarPath = '/uploaded/dummy/team/team-';

        return [
            'name' => $this->faker->name(),
            'avatar' => $this->faker->randomElement([
                $avatarPath . '1.jpg', 
                $avatarPath . '2.jpg', 
                $avatarPath . '3.jpg', 
                $avatarPath . '4.jpg'
            ]),
            'position_id' => $this->faker->numberBetween(1, 4),
            'short_desc' => $this->faker->sentence(3)
        ];
    }
}
