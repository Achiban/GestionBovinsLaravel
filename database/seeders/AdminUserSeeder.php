<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@agribovins.com'],
            [
                'name' => 'Administrateur',
                'prenom' => 'Ferme',
                'password' => Hash::make('password123'),
                'tel' => '0600000000',
                'ville' => 'Paris',
            ]
        );
    }
}
