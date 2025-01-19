<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->fixedUser([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->create();
        ;

        User::factory()->count(10)->create();
    }
}
