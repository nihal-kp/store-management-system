<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Teacher::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Store Management Admin',
            'email' => 'admin@store.com',
            'password' => bcrypt('12345678'),
            'status' => 1
        ]);

    }
}
