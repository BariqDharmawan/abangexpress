<?php

namespace Database\Seeders;

use App\Models\OurClient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class OurClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 6; $i++) { 
            OurClient::create([
                'logo' => Storage::url('clients/client-' . ($i + 1) . '.png'),
                'name' => 'client ' . $i + 1
            ]);
        }
    }
}
