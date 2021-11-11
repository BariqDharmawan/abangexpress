<?php

namespace Database\Seeders;

use App\Models\IconList;
use Illuminate\Database\Seeder;

class IconListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iconService = [
            "fas fa-truck",
            "fas fa-plane",
            "fas fa-globe",
            "fas fa-map-marker",
            "fas fa-cogs",
            "fab fa-cc-mastercard",
            "fas fa-users",
            "fas fa-train",
            "fas fa-chart-pie"
        ];
        foreach ($iconService as $icon) {
            IconList::create([
                'icon' => $icon,
                'content' => 'service',
            ]);
        }

        $iconSocial = [
            "fab fa-instagram",
            "fab fa-facebook-square",
            "fab fa-linkedin",
            "fab fa-twitter",
            "fab fa-youtube"
        ];
        foreach ($iconSocial as $icon) {
            IconList::create([
                'icon' => $icon,
                'content' => 'social',
            ]);
        }
    }
}
