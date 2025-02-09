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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@app.com',
            'password' => Hash::make('user12345'),
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('admin12345'),
        ]);
    }
}
