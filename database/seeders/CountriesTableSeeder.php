<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Region;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Asia' => [
                ['name' => 'Japan', 'code' => 'JP'],
                ['name' => 'China', 'code' => 'CN'],
                ['name' => 'Philippines', 'code' => 'PH'],
            ],
            'North America' => [
                ['name' => 'United States', 'code' => 'US'],
                ['name' => 'Canada', 'code' => 'CA'],
            ],
            'South America' => [
                ['name' => 'Brazil', 'code' => 'BR']
            ],
            'Europe' => [
                ['name' => 'United Kingdom', 'code' => 'GB'],
                ['name' => 'France', 'code' => 'FR'],
                ['name' => 'Italy', 'code' => 'IT'],
            ],
            'Oceania' => [
                ['name' => 'Australia', 'code' => 'AU']
            ],
            'Africa' => [
                ['name' => 'Morocco', 'code' => 'MA'],
                ['name' => 'South Africa', 'code' => 'ZA'],
            ],
        ];

        foreach ($data as $regionName => $countries) {
            // 既存の region を取得
            $region = Region::where('name', $regionName)->first();

            if (! $region) {
                // region が無い場合はスキップ（安全）
                continue;
            }

            foreach ($countries as $country) {
                $create = [
                    'code' => $country['code'],   
                ];

                if (Schema::hasColumn('countries', 'region_id')) {
                    $create['region_id'] = $region->id;
                }

                Country::updateOrCreate(
                    ['name' => $country['name']],
                    $create
                );
            }
        }
    }
}
