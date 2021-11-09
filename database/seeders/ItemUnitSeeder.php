<?php

namespace Database\Seeders;

use App\Helper\Helper;
use App\Models\ItemUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ItemUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = ['pcs', 'box', 'pack', 'unit', 'set'];
        foreach ($units as $unit) {
            ItemUnit::create([
                'name' => $unit,
                'domain_owner' => Arr::random(Helper::DUMMY_DOMAINS)
            ]);
        }
    }
}
