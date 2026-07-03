<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Listing::truncate();
        City::truncate();
        User::truncate();

        Schema::enableForeignKeyConstraints();

        $this->call([
            CitySeeder::class,
            ListingSeeder::class,
            UserSeeder::class,
        ]);
    }
}
