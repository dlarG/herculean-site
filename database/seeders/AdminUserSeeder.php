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
            ['username' => 'herculeandragon_admin'],
            [
                'name' => 'Herculean Dragon Admin',
                'email' => null,
                'password' => Hash::make('h3rcule4nDrag0n'),
            ]
        );
    }
}