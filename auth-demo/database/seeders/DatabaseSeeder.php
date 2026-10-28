<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // add seeders here
        ]);

        // Only seed the test user outside of production.
        if (!app()->environment('production')) {
            User::updateOrCreate(
                ['email' => 'test@test.com'],               // search key
                [
                    'name' => 'Test',
                    'password' => 'TestTest123',            // hashed automatically in user model
                ]
            );
        }
    }
}
