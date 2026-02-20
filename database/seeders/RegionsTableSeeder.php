<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['name' => 'Asia',          'code' => '001'],
            ['name' => 'North America', 'code' => '002'],
            ['name' => 'South America', 'code' => '003'],
            ['name' => 'Europe',        'code' => '004'],
            ['name' => 'Africa',        'code' => '005'],
            ['name' => 'Oceania',       'code' => '006'],
        ];

        foreach ($regions as $r) {
            Region::updateOrCreate(
                ['code' => $r['code']],   // codeをユニーク扱いに
                ['name' => $r['name']]
            );
        }
    }
}
