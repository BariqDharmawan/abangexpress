<?php

namespace Database\Factories;

use App\Models\AboutUs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class AboutUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'our_name' => $this->faker->word(2),
            'slogan' => $this->faker->sentence(3),
            'sub_slogan' => $this->faker->sentence(8),
            'our_vision' => $this->faker->paragraph(1),
            'our_mission' => '<ol><li>misi 1</li><li>misi 2</li></ol>',
            'cover_vision_mission' => $this->faker->unique()->randomElement([
                'public/cover-vision-mission/why-us.png',
                'public/cover-vision-mission/about-us1.jpg'
            ]),
            'address_embed' => $this->faker->unique()->randomElement([
                '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0"  style="border:0" allowfullscreen></iframe>',
                '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3041319359836!2d106.77262911460798!3d-6.35466186393653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eee3577291d7%3A0xab8861739a5712af!2sUpn%20%22Veteran%22%20Jakarta%2C%20Limo!5e0!3m2!1sid!2sid!4v1633583655574!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2908294261492!2d106.77329061460806!3d-6.356387563953197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69efc47d65aa19%3A0xaad8fe09fac18ba1!2sPancong%20Ruang%20Rasa%20Limo!5e0!3m2!1sid!2sid!4v1633583685705!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
            ]),
            'domain_owner' => $this->faker->unique()->randomElement([
                'http://127.0.0.1:8000',
                'http://127.0.0.1:9000'
            ]),
        ];
    }
}
