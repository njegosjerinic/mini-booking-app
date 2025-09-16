<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Poziv svih ostalih seedera
        $this->call([
            CitySeeder::class
        ]);

        $this->call(ListingSeeder::class);

        $this->call(UserSeeder::class);

    }
}

