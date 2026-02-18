<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\HotelDetail;

class HotelDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            1 => [
                [
                    'room_number' => '501',
                    'price' => 850,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '701',
                    'price' => 1200,
                    'capacity' => 3,
                    'room_type' => 'Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
            ],

            2 => [
                [
                    'room_number' => '501',
                    'price' => 800,
                    'capacity' => 4,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '801',
                    'price' => 1300,
                    'capacity' => 2,
                    'room_type' => 'Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
            ],

            3 => [
                [
                    'room_number' => '501',
                    'price' => 700,
                    'capacity' => 3,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '601',
                    'price' => 1100,
                    'capacity' => 2,
                    'room_type' => 'Double',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
            ],

            4 => [
                [
                    'room_number' => '501',
                    'price' => 900,
                    'capacity' => 4,
                    'room_type' => 'Junior Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
                [
                    'room_number' => '801',
                    'price' => 1400,
                    'capacity' => 2,
                    'room_type' => 'Executive Suite',
                    'bed_type' => 'Twin',
                    'stock' => 1,
                ],
            ],

            5 => [
                [
                    'room_number' => '701',
                    'price' => 750,
                    'capacity' => 2,
                    'room_type' => 'Queen',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '901',
                    'price' => 1250,
                    'capacity' => 3,
                    'room_type' => 'Suite',
                    'bed_type' => 'Twin',
                    'stock' => 1,
                ],
            ],

            6 => [
                [
                    'room_number' => '501',
                    'price' => 650,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '601',
                    'price' => 1000,
                    'capacity' => 4,
                    'room_type' => 'Double',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
                
            ],

            7 => [
                [
                    'room_number' => '501',
                    'price' => 950,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '901',
                    'price' => 1500,
                    'capacity' => 4,
                    'room_type' => 'King',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
            ],

            8 => [
                [
                    'room_number' => '501',
                    'price' => 1100,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '701',
                    'price' => 1600,
                    'capacity' => 3,
                    'room_type' => 'Suite',
                    'bed_type' => 'Twin',
                    'stock' => 1,
                ],
                
            ],
            
            9 => [
                [
                    'room_number' => '501',
                    'price' => 1050,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '901',
                    'price' => 1550,
                    'capacity' => 4,
                    'room_type' => 'Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
                
            ],

            10 => [
                [
                    'room_number' => '801',
                    'price' => 1200,
                    'capacity' => 2,
                    'room_type' => 'Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
                [
                    'room_number' => '901',
                    'price' => 1700,
                    'capacity' => 3,
                    'room_type' => 'Executive Suite',
                    'bed_type' => 'Twin',
                    'stock' => 1,
                ],
            ],

            11 => [
                [
                    'room_number' => '501',
                    'price' => 850,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '601',
                    'price' => 1300,
                    'capacity' => 4,
                    'room_type' => 'Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
            ],

            12 => [
                [
                    'room_number' => '501',
                    'price' => 900,
                    'capacity' => 2,
                    'room_type' => 'Deluxe',
                    'bed_type' => 'Queen',
                    'stock' => 1,
                ],
                [
                    'room_number' => '901',
                    'price' => 1400,
                    'capacity' => 3,
                    'room_type' => 'Suite',
                    'bed_type' => 'King',
                    'stock' => 1,
                ],
                
            ],

        ];

        foreach ($data as $hotelId => $rooms) {

            $hotel = Hotel::find($hotelId);

            if (!$hotel) {
                $this->command?->warn("Hotel not found: {$hotelId}");
                continue;
            }

            foreach ($rooms as $room) {

                HotelDetail::updateOrCreate(
                    [
                        'hotel_id' => $hotel->id,
                        'room_number' => $room['room_number'],
                    ],
                    [
                        'room_type' => $room['room_type'],
                        'price' => $room['price'],
                        'capacity' => $room['capacity'],
                        'stock' => $room['stock'],
                        'bed_type' => $room['bed_type'],
                    ]
                );
            }
        }
    }
}
