<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@centralhospitalindore.com');
        if (User::where('email', $email)->exists()) {
            return;
        }
        $password = env('ADMIN_PASSWORD');
        if (!$password || strlen($password) < 12) {
            throw new \RuntimeException('Set ADMIN_PASSWORD to a unique password of at least 12 characters before seeding.');
        }

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Central Hospital Indore Administrator'),
                'password' => Hash::make($password),
            ]
        );
    }
}
