<?php

namespace Database\Factories;

use App\Models\OurTeam;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $avatarPath = 'team/team-';

        return [
            'name' => $this->faker->name(),
            'avatar' => $this->faker->randomElement([
                Storage::url($avatarPath . '1.jpg'), 
                Storage::url($avatarPath . '2.jpg'), 
                Storage::url($avatarPath . '3.jpg'), 
                Storage::url($avatarPath . '4.jpg')
            ]),
            'position_id' => $this->faker->numberBetween(1, 4),
            'short_desc' => $this->faker->sentence(3)
        ];
    }
}
