<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            Vehicle::create([
                'owner_id' => $faker->numberBetween(1, 2),
                'invoice_id' => $faker->numberBetween(1, 10),
                'year' => $faker->year,
                'container_number' => $faker->lexify('???####'),
                'note' => $faker->text,
                'color' => $faker->colorName,
                'make' => $faker->word,
                'model' => $faker->word,
                'sold_price' => $faker->numberBetween(2500, 10000),
                'vin' => $faker->lexify('?????????????????'),
                'lot_number' => $faker->numberBetween(2900000323, 9000120030),

                'status' => $faker->randomElement(['on_the_way', 'sold', 'inventory']),
                'buyer_number' => $faker->lexify('Buyer#####'),
                'invoice_description' => $faker->text,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}