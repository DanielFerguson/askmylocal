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
        $victoriaLGAs = [
            'Melbourne',
            'Geelong',
            'Ballarat',
            'Bendigo',
            'Wodonga',
            'Shepparton',
            'Mildura',
            'Warrnambool',
            'Traralgon',
            'Wangaratta',
        ];

        foreach ($victoriaLGAs as $lga) {
            Locality::create([
                'state' => 'Victoria',
                'name' => $lga,
            ]);
        }
    }
}
