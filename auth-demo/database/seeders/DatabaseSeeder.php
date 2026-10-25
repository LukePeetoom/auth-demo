<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Seed the application's database.
    public function run(): void
    {
        // Makes it so it can only run seeders outside of production.
        if (app()->environment('production')) {
            return;
        }

        User::updateOrCreate(
            ['email' => 'test@test.com'],               // search key
            [
                'name' => 'Test',                       // values to set
                'password' => 'TestTest123'             // hashed automatically
            ]
        );
    }
}
