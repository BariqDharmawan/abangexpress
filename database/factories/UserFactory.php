<?php

namespace Database\Factories;

use App\Helper\Helper;
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
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->randomElement([
                'subadmin1', 'subadmin2', 'subadmin3', 'subadmin4', 'subadmin5'
            ]),
            'role' => 'sub-admin',
            'code_api' => 'coloader',
            'password' => Hash::make('passwordsubadmin'),
            'lt' => null,
            'token_api' => 'f03e563b71454776e2cb1e7b5f5ea5c4',
            'plain_password' => md5('passwordsubadmin'),
            'domain_owner' => $this->faker->unique(true)->randomElement(
                Helper::DUMMY_DOMAINS
            )
        ];
    }

}
