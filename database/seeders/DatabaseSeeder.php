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
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
User::truncate();
        \App\Models\User::factory()->create([
            'name' => 'Zenith Admin',
            'email' => 'zenithadmin@zbtradeseminar.com',
            'password' => Hash::make('zenith@1234')
        ]);
    }
}
