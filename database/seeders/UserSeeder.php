<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => "employee{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'employee',
            ]);
        }
    }
}
