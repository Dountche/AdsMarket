<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'fstname'           => 'Principal',
            'email'             => 'admin@example.com',
            'passwd'          => Hash::make('admin123'),
            'is_admin'          => true,
            'phone'             => '0502040103',
            'email_verified_at' => now(),
            'profil_path' => 'avatars/default.png',
        ]);

    }
}
