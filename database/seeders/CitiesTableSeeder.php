<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Asia' => [
                'JP' => ['Tokyo'],
                'CN' => ['Beijing'],
                'PH' => ['Manila'],
            ],

            'North America' => [
                'US' => ['New York'],
                'CA' => ['Toronto'],
            ],

            'South America' => [
                'BR' => ['Iguassu Falls'],
            ],

            'Europe' => [
                'GB' => ['London'],
                'FR' => ['Paris'],
                'IT' => ['Rome'],
            ],

            'Africa' => [
                'MA' => ['Marrakech'],
                'ZA' => ['Cape Town'],
            ],

            'Oceania' => [
                'AU' => ['Perth'],
            ],
        ];

        foreach ($data as $regionName => $countries) {
            $region = Region::where('name', $regionName)->first();
            if (! $region) {
                continue;
            }

            foreach ($countries as $countryCode => $cities) {
                $country = Country::where('code', $countryCode)->first();
                if (! $country) {
                    continue;
                }

                foreach ($cities as $cityName) {
                    City::firstOrCreate(
                        [
                            'name' => $cityName,
                            'country_id' => $country->id,
                        ],
                        [
                            'region_id' => $region->id,
                        ]
                    );
                }
            }
        }
    }
}
