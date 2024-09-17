<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'email' => 'admin@example.com',
            'profile_id' => 1,
            'password' => Hash::make('admin'),
        ]);

        \App\Models\Customer::insert([
            'name' => 'admin',
            'surname' => 'admin',
            'user_id' => $user->refresh()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \App\Models\Hobbie::insert([
            'name' => 'Fútbol',
        ]);

       \App\Models\Hobbie::insert([
        'name' => 'Cocina',
        ]);
    }
}
