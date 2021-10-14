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
            'http://127.0.0.1:9000'
        ];
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique(true)->randomElement([
                'admincompany1', 'admincompany2', 'admincompany3'
            ]),
            'password' => Hash::make('passwordadmin'),
            'plain_password' => 'passwordadmin',
            'role' => 'admin',
            'code_api' => 'CAX0135',
            'domain_owner' => $this->faker->unique()->randomElement($domains),
            'remember_token' => Str::random(10),
        ];
    }

    public function subAdmin()
    {
        return $this->state(function (array $attributes){
            return [
                'username' => $this->faker->unique()->randomElement([
                    'subadmin1', 'subadmin2', 'subadmin3', 'subadmin4', 'subadmin5'
                ]),
                'role' => 'sub-admin',
                'code_api' => 'coloader',
                'password' => Hash::make('passwordsubadmin'),
                'token_api' => 'f03e563b71454776e2cb1e7b5f5ea5c4',
                'plain_password' => 'passwordsubadmin'
            ];
        });
    }
}
