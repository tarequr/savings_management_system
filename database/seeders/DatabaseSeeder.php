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
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '01234567890',
        ]);

        $members = [
            [
                'name' => 'Masum Billah',
                'email' => 'masum@app.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '01234567891',
            ],
            [
                'name' => 'Taiyebur Rahman Tipu',
                'email' => 'tipu@app.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '01234567892',
            ],
            [
                'name' => 'Tarequr Rahman Sabbir',
                'email' => 'sabbir@app.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '01234567893',
            ],
            [
                'name' => 'Sohag Sarder',
                'email' => 'sohag@app.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '01234567894',
            ],
            [
                'name' => 'Humaun Kabir',
                'email' => 'kabir@app.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '01234567895',
            ],
            [
                'name' => 'Tanjim Hasan Radin',
                'email' => 'radin@app.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'phone' => '01234567896',
            ]
        ];

        foreach ($members as $member) {
            User::create($member);
        }

    }
}
