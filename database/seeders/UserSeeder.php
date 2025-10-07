<?php 

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder{

    public function run()
    {
        DB::table('users')->truncate();
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
    }

}