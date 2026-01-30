<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '01234567890',
        ]);

        // Create Members
        User::factory(10)->create([
            'role' => 'member',
            'password' => bcrypt('password'),
        ]);
    }
}
