<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Josh',
            'email' => "joshua@gizmosystemsolutionsinc.com",
            'role_name' => 'admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
