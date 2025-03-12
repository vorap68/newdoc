<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        User::create([
            'id' => fake()->uuid(),
            'first_name' =>  'dimon',
            'last_name' =>   'last_dimon',
            'middle_name' => 'middle_dimon',
            'origin_name' => 'dimon',
            'email' => 'dimon@com.org',
            'password' => Hash::make('dmitry13'),
        ]);
    }
}
