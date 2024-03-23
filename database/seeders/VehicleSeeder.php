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

        for ($i = 0; $i < 350; $i++) {
            Vehicle::create([
                'customer_id' => $faker->numberBetween(1, 5),
                'year' => $faker->year,
                'container_number' => $faker->lexify('???####'),
                'title_received_date' => $faker->date(),
                'title_number' => $faker->lexify('?????####'),
                'title_status' => $faker->state,
                'purchase_date' => $faker->date(),
                'pickup_date' => $faker->date(),
                'deliver_date' => $faker->date(),
                'note' => $faker->text,
                'color' => $faker->colorName,
                'model' => $faker->word,
                'vin' => $faker->lexify('?????????????????'),
                'weight' => $faker->randomNumber(4),
                'cbm' => $faker->randomFloat(2, 1, 10),
                'licence_number' => $faker->lexify('???####'),
                'lot_number' => $faker->numberBetween(2900000323, 9000120030),
                'hat_number' => $faker->lexify('HT#####'),
                'customer_remark' => $faker->sentence,
                'make' => $faker->word,
      
                'created_by' => 1,
                'updated_by' => 1,
                'status' => $faker->randomElement(['pending', 'on_the_way', 'on_hand_with_title', 'on_hand_no_title', 'shipped']),
                'ship_as' => $faker->randomElement(['half-cut', 'complete']),
                'is_key' => $faker->randomElement(['Yes', 'No']),
                'payment_date' => $faker->date(),
                'point_of_loading_id' => $faker->numberBetween(1, 5),
                'buyer_number' => $faker->lexify('Buyer#####'),
                'photos_link' => $faker->url,
                'auction' => $faker->word,
                'auction_city' => $faker->city,

                'vehicle_price' => $faker->randomFloat(2, 0, 999999.99),
                'towing_charge' => $faker->randomFloat(2, 0, 999999.99),
                'auction_fee_charge' => $faker->randomFloat(2, 0, 999999.99),
                'dismantal_charge' => $faker->randomFloat(2, 0, 999999.99),
                'shiping_charge' => $faker->randomFloat(2, 0, 999999.99),
                'storage_charge' => $faker->randomFloat(2, 0, 999999.99),
                'custom_charge' => $faker->randomFloat(2, 0, 999999.99),
                'demurage_charge' => $faker->randomFloat(2, 0, 999999.99),
                'other_charge' => $faker->randomFloat(2, 0, 999999.99),
                'towing_cost' => $faker->randomFloat(2, 0, 999999.99),
                'auction_fee_cost' => $faker->randomFloat(2, 0, 999999.99),
                'dismantal_cost' => $faker->randomFloat(2, 0, 999999.99),
                'ship_cost' => $faker->randomFloat(2, 0, 999999.99),
                'storage_cost' => $faker->randomFloat(2, 0, 999999.99),
                'custom_cost' => $faker->randomFloat(2, 0, 999999.99),
                'demurage_cost' => $faker->randomFloat(2, 0, 999999.99),
                'other_cost' => $faker->randomFloat(2, 0, 999999.99),
            ]);
        }
    }
}