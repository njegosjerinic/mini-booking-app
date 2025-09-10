<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Belgrade',
            'Novi Sad',
            'Niš',
            'Podgorica',
            'Sarajevo',
            'Zagreb',
            'Ljubljana',
            'Skopje',
            'Split',
            'Dubrovnik',
        ];

        foreach ($cities as $city) {
            City::firstOrCreate(['name' => $city]);
        }
    }
}
