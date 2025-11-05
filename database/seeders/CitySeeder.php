<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
