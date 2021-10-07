<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $domains = [
            'http://127.0.0.1:8000', 
            'http://127.0.0.1:9000', 
            'http://127.0.0.;1:10000'
        ];
        return [
            'name' => $this->faker->sentence(2),
            'username' => $this->faker->unique()->randomElement([
                'admincompany1', 'admincompany2', 'admincompany3'
            ]),
            'password' => Hash::make('passwordadmin'),
            'plain_password' => 'passwordadmin',
            'role' => 'admin',
            'domain_owner' => $this->faker->unique()->randomElement($domains),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
