<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::factory()->create([
             'firstname' => 'Admin',
             'lastname' => 'Admin',
             'email' => 'admin@tranzie.com',
             'country' => 'Nigeria',
             'password' => bcrypt('@Tranzie1010'),
             'role' => 'admin',
         ]);
    }
}
