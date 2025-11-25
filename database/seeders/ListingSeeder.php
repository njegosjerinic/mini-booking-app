<?php

namespace Database\Seeders;

use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'city_id' => 3,
                'price_per_night' => 45.00,
                'beds' => 2,
                'max_persons' => 3,
                'image_path' => '/listings/apartman1.jpg',
            ],
            [
                'name' => 'Hotel Plaza',
                'description' => 'Luksuzni hotel sa pogledom na more.',
                'city_id' => 2,
                'price_per_night' => 120.00,
                'beds' => 1,
                'max_persons' => 2,
                'image_path' => '/listings/hotel1.jpg',
            ],
            [
                'name' => 'Vila Raj',
                'description' => 'Prostrana vila sa bazenom, pogodna za porodice.',
                'city_id' => 3,
                'price_per_night' => 200.00,
                'beds' => 4,
                'max_persons' => 8,
                'image_path' => '/listings/villa1.jpg',
            ],
            [
                'name' => 'Hostel Centar',
                'description' => 'Povoljno prenoćište u centru, deljeni kreveti.',
                'city_id' => 2,
                'price_per_night' => 15.00,
                'beds' => 10,
                'max_persons' => 10,
                'image_path' => '/listings/hostel1.jpg',
            ],
            // Novi smeštaji
            [
                'name' => 'Garni Hotel Green',
                'description' => 'Eko hotel sa modernim sobama i doručkom.',
                'city_id' => 1,
                'price_per_night' => 60.00,
                'beds' => 2,
                'max_persons' => 2,
                'image_path' => '/listings/hotel_green.jpg',
            ],
            [
                'name' => 'Seosko domaćinstvo Etno',
                'description' => 'Tradicionalna kuća u etno stilu, savršena za odmor.',
                'city_id' => 4,
                'price_per_night' => 35.00,
                'beds' => 3,
                'max_persons' => 5,
                'image_path' => '/listings/etno_house.jpg',
            ],
            [
                'name' => 'Penthouse Panorama',
                'description' => 'Ekskluzivan apartman sa panoramskim pogledom na grad.',
                'city_id' => 1,
                'price_per_night' => 150.00,
                'beds' => 2,
                'max_persons' => 4,
                'image_path' => '/listings/penthouse.jpg',
            ],
            [
                'name' => 'Planinska koliba Snežana',
                'description' => 'Koliba na planini sa kaminom i drvenim enterijerom.',
                'city_id' => 5,
                'price_per_night' => 80.00,
                'beds' => 3,
                'max_persons' => 6,
                'image_path' => '/listings/cabin.jpg',
            ],
            [
                'name' => 'Boutique Hotel Central',
                'description' => 'Mali boutique hotel sa luksuznim sobama.',
                'city_id' => 2,
                'price_per_night' => 110.00,
                'beds' => 1,
                'max_persons' => 2,
                'image_path' => '/listings/boutique_hotel.jpg',
            ],
            [
                'name' => 'Apartman Lux',
                'description' => 'Komforan apartman sa jacuzzijem i privatnim parkingom.',
                'city_id' => 3,
                'price_per_night' => 90.00,
                'beds' => 2,
                'max_persons' => 4,
                'image_path' => '/listings/apartman_lux.jpg',
            ],
            [
                'name' => 'Kamp Sunny',
                'description' => 'Mesto za šatore i kampere uz reku.',
                'city_id' => 4,
                'price_per_night' => 10.00,
                'beds' => 0,
                'max_persons' => 20,
                'image_path' => '/listings/camp.jpg',
            ],
            [
                'name' => 'Studio Modern',
                'description' => 'Mali moderan studio idealan za kraći boravak.',
                'city_id' => 1,
                'price_per_night' => 40.00,
                'beds' => 1,
                'max_persons' => 2,
                'image_path' => '/listings/studio_modern.jpg',
            ],
            [
                'name' => 'Resort Paradise',
                'description' => 'Veliki resort sa spa centrom i restoranom.',
                'city_id' => 5,
                'price_per_night' => 250.00,
                'beds' => 5,
                'max_persons' => 12,
                'image_path' => '/listings/resort.jpg',
            ],
        ];

        foreach ($listings as $listing) {
            Listing::create($listing);
        }
    }
}
