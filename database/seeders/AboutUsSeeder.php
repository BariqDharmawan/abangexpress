<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'our_name' => 'asfa ksflf',
            'slogan' => 'Better Solutions For Your Business',
            'sub_slogan' => 'We are team of talented designers making websites with Bootstrap anjai',
            'our_vision' => 'Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore.',
            'our_mission' => '<ol><li>misi 1</li><li>misi 2</li></ol>',
            'our_video' => 'https://www.youtube.com/watch?v=-Luq277seyM',
            'cover_vision_mission' => Storage::url('cover-vision-mission/why-us.png'),
            'address_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0"  style="border:0" allowfullscreen></iframe>',
            'user_id' => 1
        ]);
    }
}
