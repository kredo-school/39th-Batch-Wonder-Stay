<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Facades\Schema;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void
    {   
        $data = [

            [
                'region' => 'Asia',
                'country_code' => 'JP',
                'city' => 'Tokyo',
                'name' => 'The Ritz-Carlton, Tokyo',
                'concept' => 'A beautiful space where East and West blend beautifully',
                'feature' => 'The hotel offers a total of 245 guest rooms that blend Japanese aesthetics with sophisticated luxury, a relaxing Club Lounge with a mansion-like atmosphere that transcends conventional notions, a wide range of dining options including a French restaurant overseen by a three-star Michelin chef, and a spa where you can experience blissful relaxation.We welcome you with personal and heartwarming hospitality, along with a wide range of facilities.',
                'service' => [
                    '24-hour front desk',
                    'Concierge service',
                    'Currency exchange',
                ],
                'description' => "The Ritz-Carlton, Tokyo towers over Roppongi, the city's pulsating nightlife district. The hotel takes up residence on the top nine floors of the 53-story Tokyo Midtown, one of the city's tallest buildings.",
                'address' => 'Tokyo, Japan, 107-6245',
                'phone' => '+81 3-3423-8000',
                'email' => 'rc.tyorz.room.reservation@ritzcarlton.com',
            ],

            [
                'region' => 'Asia',
                'country_code' => 'CN',
                'city' => 'Beijing',
                'name' => 'The Peninsula Beijing',
                'concept' => 'Heart of the Capital, Timeless Elegance',
                'feature' => 'The Peninsula Beijing is a luxury hotel located in the heart of Beijing, offering guests a blend of traditional Chinese culture and modern amenities.',
                'service' => [
                    'Renovated into an all-suite property',
                    'The largest guest rooms in the city',
                    'In-room tablet check-in',
                    'Yun Summer Lounge - the seasonal rooftop space',
                    'A Peninsula-sponsored art gallery',
                    'Cash-free payments for all experiences',
                ],
                'description' => "Classic luxury in the heart of the city",
                'address' => "8 Goldfish Lane, Wangfujing, Beijing 100006, People's Republic of China",
                'phone' => '86-10-8516-2888',
                'email' => 'pbj@peninsula.com',
            ],

            [
                'region' => 'Asia',
                'country_code' => 'PH',
                'city' => 'Manila',
                'name' => 'Sky Tower at Solaire Resort Entertainment City',
                'concept' => 'A haven of luxury in the heart of Manila',
                'feature' => "The gleaming 17-story Sky Tower, located within Solaire Resort Entertainment City, is the most recent addition to the resort company's growing gaming complex along the picturesque Manila Bay in the Philippines. Considered a ...",
                'service' => [
                    'Spoilt for choice from table games to classic slots at the hotel casino',
                    'Exciting shopping and comfortable rest at The Shoppes At Solaire',
                    "State-of-the-art audiovisual equipment and meeting rooms, gourmet menus and customized corporate meeting packages at all of Solaire's function rooms"
                ],
                'description' => "The Sky Tower at Solaire Resort & Casino has been named to the Forbes Travel Guide 5-Star Star Rating for the sixth consecutive year as one of the best hotels in the world for our impeccable service and phenomenal hotel amenities. Once you set foot in one of our finest rooms, you'll be treated royally.",
                'address' => "1 Aseana Avenue, Entertainment City, Paranaque, 1300 Manila, Philippines",
                'phone' => '+632 8888-8888',
                'email' => 'reserv@skytowerspins.com',
            ],

            [
                'region' => 'North America',
                'country_code' => 'US',
                'city' => 'New York',
                'name' => 'The Ritz-Carlton New York, Central Park',
                'concept' => 'A classic Midtown pick reawakens',
                'feature' => 'The all-day gastro lounge Contour, The Ritz-Carlton Club® Lounge, and a collection of wellness experiences, including the first stateside La Prairie Spa and innovative Movement Studio',
                'service' => [
                    'The second floor La Prairie Spa',
                    'Bellman who offers to fill your ice bucket after bringing up your luggage',
                    'Concierge who tailors dining recommendations to suit your tastes',
                ],
                'description' => "Steps from Manhattan's finest attractions and renowned cultural attractions, this 253-room Central Park hotel in NYC is rated as a Forbes Five-Star and AAA Five Diamond Hotel. ",
                'address' => "50 Central Park South, New York, New York, USA, 10019",
                'phone' => '+1 212-308-9100',
                'email' => 'reservations@ritzcarlton.com',
            ],

            [
                'region' => 'North America',
                'country_code' => 'CA',
                'city' => 'Toronto',
                'name' => 'The St. Regis Toronto',
                'concept' => 'The Finest Luxury Downtown Toronto Hotel Experience',
                'feature' => ['Deluxe, urban and modern, softened with classic touches of glamour that hearken back to the Golden Age of Hollywood',
                             "The designers' color palette of caviar and champagne",
                             '61-foot pool',
                             'The perfect location for shopping and entertainment'],
                'service' => [
                    'Service for exclusive members',
                    'St. Regis Signature Rituals',
                    'Butler Service - no request is too small or unattainable, no matter the hour of the day'
                ],
                'description' => "When this building opened in January 2012, it was a dramatic addition to Toronto's skyline. With its gleaming silver spire, The St. Regis Toronto is Canada’s tallest residential building and, at 900 feet, offers one of the ...",
                'address' => "100 Front Street West, Toronto, Ontario M5J 1E3",
                'phone' => '+1 416-362-2222',
                'email' => 'reservations@stregistoronto.com',
            ],

            [
                'region' => 'South America',
                'country_code' => 'BR',
                'city' => 'Iguassu Falls',
                'name' => 'Hotel das Cataratas, A Belmond Hotel, Iguassu Falls',
                'concept' => "INTIMACY WITH THE WORLD'S LARGEST FALLS",
                'feature' => ['The hotel is located in the heart of Iguassu Falls, offering guests a unique and immersive experience',
                             'The hotel features 100 luxury rooms and suites with panoramic views of the falls',
                             'The hotel has a world-class spa and wellness center',
                             'The hotel offers a variety of dining options, including a Michelin-starred restaurant'],
                'service' => [
                    'Swimming Pool',
                    'Fitness center open 24 hours daily',
                    'Free Tennis garden'
                ],
                'description' => "The dashing good looks of Hotel das Cataratas, A Belmond Hotel, Iguassu Falls, an ice-cream pink estate, are trumped only by the breathtaking natural wonder of its setting.",
                'address' => "Av. das Cataratas 1000, Iguassu Falls, PR 85600-000",
                'phone' => '+55 42 3211-1234',
                'email' => 'reservations@hoteldascataratas.com',
            ],

            [
                'region' => 'Europe',
                'country_code' => 'GB',
                'city' => 'London',
                'name' => "Claridge's",
                'concept' => 'Timeless Elegance in Mayfair',
                'feature' => ['The hotel is located in the heart of Mayfair, offering guests a unique and immersive experience',
                             'The hotel features 100 luxury rooms and suites with panoramic views of the city',
                             'The hotel has a world-class spa and wellness center',
                             'The hotel offers a variety of dining options, including a Michelin-starred restaurant'],
                'service' => [
                    'A Recipe for Refinement',
                    "24-hour access to your personal Claridge's butler",
                    "Claridge's Bakery",
                    'Spa',
                    "Weddings at Claridge's"
                ],
                'description' => "Claridge's radiates art deco glamour. This Forbes Travel Guide Five-star London hotel has been opening its doors to guests since 1856, becoming a regular go-to for a roll call of who's who, including Queen Victoria and ...",
                'address' => "100 Piccadilly, London W1J 9AT",
                'phone' => '+44 20 7221 1234',
                'email' => 'reservations@claridges.com',
            ],

            [
                'region' => 'Europe',
                'country_code' => 'FR',
                'city' => 'Paris',
                'name' => 'Hotel Plaza Athénée Paris',
                'concept' => 'The Haute Couture Address',
                'feature' => 'The gastronomy of Haute Couture provide a variety of atmospheres to suit all moods',
                'service' => [
                    'Ice skating for little ones',
                    'Live music at Le Relais Plaza',
                    'Gift Cards'
                ],
                'description' => "True to its extraordinary city, Hôtel Plaza Athénée is no ordinary hotel. Here, on prestigious avenue Montaigne, the tree-lined boulevard of French fashion, our hotel proudly offers guests the very best of Paris.",
                'address' => "100 Avenue Montaigne, 75008 Paris",
                'phone' => '+33 1 53 42 22 22',
                'email' => 'reservations@plaza-athenee.com',
            ],

            [
                'region' => 'Europe',
                'country_code' => 'IT',
                'city' => 'Rome',
                'name' => 'Hotel Eden',
                'concept' => 'Where work and relaxation merge harmoniously',
                'feature' => ['A proximity to the Porte de Versailles Exhibition Center',
                'Delicate and sunny atmospheres',
                'Immerse in year-round flower garden and enjoy our wellness facilities, including hammam, sauna and fitness room',
                'Take advantage of our coworking space to work in peace and quiet'],
                'service' => [
                    'A Hammam & a Sauna',
                    'A Fitness Room',
                    'Massages',
                    'The patio',
                    'Honesty bar',
                ],
                'description' => "When it debuted in 1889, Hotel Eden defined Roman elegance, a title it maintains to this day",
                'address' => "Via del Corso 123, Rome, Italy",
                'phone' => '+39 06 12345678',
                'email' => 'reservations@hotel-eden.com',
            ],

            [
                'region' => 'Africa',
                'country_code' => 'MA',
                'city' => 'Marrakech',
                'name' => 'Royal Mansour Marrakech',
                'concept' => 'Sparking emotions, creating experiences',
                'feature' => [
                    'Traditional Moroccan architecture and design',
                    'Luxurious riads with private courtyards and pools',
                    'The design incorporates the elements of an authentic medina',
                    'The rooms and suites have been replaced by luxurious riads and the corridors by winding alleyways'],
                'service' => [
                    '4 Signature restaurants',
                    'An exclusive collection of 53 private riads',
                    'Le Jardin and its swimming pool',
                    'A unique wellness destination'
                                ],
                'description' => "Commissioned by the King of Morocco with the aim to capture the best of the country's architecture and visual culture, Royal Mansour Marrakech is nothing short of immaculate. With 80 percent of the hotel crafted by hand, ...",
                'address' => "123 Avenue Mohammed V, Marrakech",
                'phone' => '+212 524 444 555',
                'email' => 'reservations@royalmansour.com',
            ],

            [
                'region' => 'Africa',
                'country_code' => 'ZA',
                'city' => 'Cape Town',
                'name' => 'Mount Nelson, A Belmond Hotel, Cape Town',
                'concept' => 'The Joyful Home of Cape Town',
                'feature' => [
                    'Nestled between the slopes of Table Mountain and the vibrant city.',
                    "Pioneering gastronomy with local roots and close collaboration with South Africa's creative community, the Nellie has a vintage heart and innovative spirit."
                ],
                'service' => [
                    'A regular shuttle service',
                    'Swimming pools',
                    'Fitness center',
                    'Pet amenities',
                    'Hair salon service'
                ],
                'description' => "Painted pink in 1918 to commemorate peace and the end of World War I, Mount Nelson, A Belmond Hotel, Cape Town is one of Cape Town's most talked-about landmarks.",
                'address' => "123 Main Road, Cape Town",
                'phone' => '+27 21 123 4567',
                'email' => 'reservations@mountnelson.com',
            ],

            [
                'region' => 'Oceania',
                'country_code' => 'AU',
                'city' => 'Perth',
                'name' => 'Crown Towers Perth',
                'concept' => 'The Height of Luxury',
                'feature' => 'Beautifully appointed guest rooms and suites are unparalleled in every way',
                'service' => [
                    'Bulter',
                    'Crystal Club',
                    'Renowned Fine Dining'
                ],
                'description' => "Deemed one of the most expensive hotel builds in the country, Crown Towers Perth is Western Australia’s undisputed destination resort. Exuding understated glamour, Perth's most extravagant stay is ideally situated just a few ...",
                'address' => "123 Crown Street, Perth",
                'phone' => '+61 8 1234 5678',
                'email' => 'reservations@crowntowersperth.com',
            ],
            // ← ホテル増やすときはここに足すだけ
        ];

        foreach ($data as $row) {
            $region  = Region::where('name', $row['region'])->first();
            if (! $region) continue;

            $country = Country::where('code', $row['country_code'])->first();
            if (! $country) continue;

            $city = City::where('name', $row['city'])
                        ->where('country_id', $country->id)
                        ->first();
            if (! $city) continue;

            Hotel::updateOrCreate(
                ['name' => $row['name']],
                [
                    'concept' => $row['concept'],
                    'feature' => $row['feature'],
                    'service' => $row['service'],
                    'address' => $row['address'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'region_id' => $region->id,
                    'country_id' => $country->id,
                    'city_id' => $city->id,
                ]
            );
        }
    }
}
