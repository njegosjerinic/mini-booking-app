<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listings = [
            [
                'name' => 'Apartman Sunce',
                'description' => 'Moderan apartman u centru grada, idealan za parove.',
                'city_id' => 3, // poveži sa gradom iz cities tabele
                'price_per_night' => 45.00,
                'beds' => 2,
                'max_persons' => 3,
                'image_path' => 'apartman1.jpg',
            ],
            [
                'name' => 'Hotel Plaza',
                'description' => 'Luksuzni hotel sa pogledom na more.',
                'city_id' => 2,
                'price_per_night' => 120.00,
                'beds' => 1,
                'max_persons' => 2,
                'image_path' => 'hotel1.jpg',
            ],
            [
                'name' => 'Vila Raj',
                'description' => 'Prostrana vila sa bazenom, pogodna za porodice.',
                'city_id' => 3,
                'price_per_night' => 200.00,
                'beds' => 4,
                'max_persons' => 8,
                'image_path' => 'villa1.jpg',
            ],
            [
                'name' => 'Hostel Centar',
                'description' => 'Povoljno prenoćište u centru, deljeni kreveti.',
                'city_id' => 2,
                'price_per_night' => 15.00,
                'beds' => 10,
                'max_persons' => 10,
                'image_path' => 'hostel1.jpg',
            ],
        ];

        foreach ($listings as $listing) {
            Listing::create($listing);
        }
    }
}
