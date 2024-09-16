<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Yang Punya',
            'email' => 'yangpunya@example.com',
            'password' => Hash::make('marafelue12345678'),
            'authority' => 'superadmin',
            'photo_file' => 'profile_photos/kocheng.jpg',
        ]);

        User::query()->create([
            'name' => 'Panitia',
            'email' => 'panitia@example.com',
            'password' => Hash::make('yangpanitiaaja'),
            'authority' => 'superadmin',
            'photo_file' => 'profile_photos/panitia.jpg',
        ]);

        User::query()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'authority' => 'superadmin',
            'photo_file' => 'profile_photos/superadmin.jpg',
        ]);

        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'authority' => 'admin',
            'photo_file' => 'profile_photos/admin.jpg',
        ]);

        User::query()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'authority' => 'user',
            'photo_file' => 'profile_photos/user.jpg',
        ]);

        $this->call(CategorySeeder::class);
    }
}
