<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $faker = Factory::create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        \App\Models\Location::insert([
            ['name' => $faker->name],
            ['name' => $faker->name],
            ['name' => $faker->name],
            ['name' => $faker->name],
            ['name' => $faker->name],
        ]);
        \App\Models\Customer::insert([
            ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt($faker->password) ],
            ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt($faker->password) ],
            ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt($faker->password) ],
            ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt($faker->password) ],
            ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt($faker->password) ],
        ]);

        $this->call(VehicleSeeder::class);
        $this->call(TimeZonesSeeder::class);
    }
}