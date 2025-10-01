<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'user_name' => env('NAME', 'Admin'),
            'user_badge' => env('BADGE', '00000'),
            'join_date' => '1000-01-01',
            'end_date' => '3000-01-01',
            'position' => '-',
            'school' => '-',
            'email' => env('EMAIL', 'admin@gmail.com'),
            'password' => env('PASSWORD', 'password'),
            'is_admin' => true,
        ]);
    }
}
