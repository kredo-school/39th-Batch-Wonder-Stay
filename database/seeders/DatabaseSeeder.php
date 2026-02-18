<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            LanguageSeeder::class,

            RegionsTableSeeder::class,
            CountriesTableSeeder::class,
            CitiesTableSeeder::class,

            HotelsTableSeeder::class,
            HotelPhotosTableSeeder::class,
            HotelDetailsTableSeeder::class,
            PaymentMethodSeeder::class,
            
        ]);
    }
}
