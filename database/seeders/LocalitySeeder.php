<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Seeder;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $background_url = '/assets/shires/pyrenees-banner.jpg';

        $victoriaLGAs = [
            ['name' => 'Brimbank City', 'photo_url' => '/assets/shires/brimbank.png', 'background_photo_url' => $background_url],
            ['name' => 'Colac Otway Shire', 'photo_url' => '/assets/shires/colac.png', 'background_photo_url' => $background_url],
            ['name' => 'Golden Plains Shire', 'photo_url' => '/assets/shires/golden-plains.webp', 'background_photo_url' => $background_url],
            ['name' => 'Pyrenees Shire', 'photo_url' => '/assets/shires/pyrenees.jpg', 'background_photo_url' => $background_url],
            ['name' => 'Whittlesea City', 'photo_url' => '/assets/shires/whittlesea.webp', 'background_photo_url' => $background_url],
        ];

        foreach ($victoriaLGAs as $lga) {
            Locality::create([
                'state' => 'Victoria',
                'name' => $lga['name'],
                'profile_photo_url' => $lga['photo_url'],
                'background_photo_url' => $lga['background_photo_url'],
            ]);
        }
    }
}
