<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@infinity.local'],
            [
                'name' => 'Administrator Infinity',
                'password' => Hash::make('admin1234'),
                'rol' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'editor@infinity.local'],
            [
                'name' => 'Editor Infinity',
                'password' => Hash::make('editor1234'),
                'rol' => 'editor',
                'email_verified_at' => now(),
            ]
        );
    }
}
