<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\HotelPhoto;

class HotelPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // どのホテルにどの写真を入れるか（pathは storage/app/public 配下を想定）
        $data = [
            'The Ritz-Carlton, Tokyo' => [
                ['path' => 'images/ritz-tokyo/ritz-main.jpeg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/ritz-tokyo/ritz-room.avif',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/ritz-tokyo/ritz-sweet.avif',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/ritz-tokyo/ritz-5-dining.jpeg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/ritz-tokyo/rit-4z-service.jpeg',    'sort_order' => 4, 'is_main' => false],
            ],
            'The Peninsula Beijing' => [
                ['path' => 'images/the-peninsula-beijing/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/the-peninsula-beijing/deluxe-living-room.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/the-peninsula-beijing/deluxe-bathroom.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/the-peninsula-beijing/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/the-peninsula-beijing/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'Sky Tower at Solaire Resort Entertainment City' => [
                ['path' => 'images/manila/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/manila/suite.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/manila/bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/manila/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/manila/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'The Ritz-Carlton New York, Central Park' => [
                ['path' => 'images/new-york/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/new-york/royal-suite.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/new-york/suite-bathroom.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/new-york/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/new-york/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'The St. Regis Toronto' => [
                ['path' => 'images/toronto/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/toronto/Suite-Master-Bedroom.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/toronto/suite-bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/toronto/lounge.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/toronto/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'Hotel das Cataratas, A Belmond Hotel, Iguassu Falls' => [
                ['path' => 'images/brazil/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/brazil/room.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/brazil/bathroom.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/brazil/bar.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/brazil/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            "Claridge's" => [
                ['path' => 'images/claridges/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/claridges/room.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/claridges/bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/claridges/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/claridges/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            "Hotel Plaza Athénée Paris" => [
                ['path' => 'images/paris/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/paris/suite.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/paris/bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/paris/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/paris/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'Hotel Eden' => [
                ['path' => 'images/rome/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/rome/suite.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/rome/bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/rome/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/rome/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'Royal Mansour Marrakech' => [
                ['path' => 'images/marrakech/main.webp', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/marrakech/room.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/marrakech/bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/marrakech/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/marrakech/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'Mount Nelson, A Belmond Hotel, Cape Town' => [
                ['path' => 'images/cape-town/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/cape-town/room.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/cape-town/bath.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/cape-town/bar.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/cape-town/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ],
            'Crown Towers Perth' => [
                ['path' => 'images/perth/main.jpg', 'sort_order' => 0, 'is_main' => true],
                ['path' => 'images/perth/deluxe-room.jpg',    'sort_order' => 1, 'is_main' => false],
                ['path' => 'images/perth/bathroom.jpg',    'sort_order' => 2, 'is_main' => false],
                ['path' => 'images/perth/dining.jpg',    'sort_order' => 3, 'is_main' => false],
                ['path' => 'images/perth/service.jpg',    'sort_order' => 4, 'is_main' => false],
            ]
        ];

        foreach ($data as $hotelName => $photos) {
            $hotel = Hotel::where('name', $hotelName)->first();

            if (!$hotel) {
                // ホテルがまだ無ければスキップ（必要なら create してもOK）
                $this->command?->warn("Hotel not found: {$hotelName} (skipped)");
                continue;
            }

            foreach ($photos as $p) {
                // 何回 seed しても同じ path は重複作成しない
                HotelPhoto::updateOrCreate(
                    [
                        'hotel_id' => $hotel->id,
                        'path'     => $p['path'],
                    ],
                    [
                        'sort_order' => $p['sort_order'],
                        'is_main'    => $p['is_main'],
                    ]
                );
            }

            // 「is_main が複数」事故防止：メインは1枚に揃える（最後に true のやつ優先）
            $main = HotelPhoto::where('hotel_id', $hotel->id)->where('is_main', true)->orderBy('sort_order')->first();
            if ($main) {
                HotelPhoto::where('hotel_id', $hotel->id)->update(['is_main' => false]);
                $main->update(['is_main' => true]);
            }
        }
    }
}
