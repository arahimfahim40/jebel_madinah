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

        for ($i = 0; $i < 50; $i++) {
            Vehicle::create([
                
                'year' => $faker->year,
                'container_number' => $faker->lexify('???####'),
                'title_received_date' => $faker->date(),
                'title_number' => $faker->lexify('?????####'),
                'title_state' => $faker->state,
                'purchase_date' => $faker->date(),
                'pickup_date' => $faker->date(),
                'deliver_date' => $faker->date(),
                'note' => $faker->text,
                'color' => $faker->colorName,
                'model' => $faker->word,
                'vin' => $faker->lexify('?????????????????'),
                'weight' => $faker->randomNumber(4) . ' kg',
                'cbm' => $faker->randomFloat(2, 1, 10),
                'value' => $faker->randomNumber(4) . ' USD',
                'licence_number' => $faker->lexify('???####'),
                'storage_amount' => $faker->randomNumber(2) . ' USD',
                'check_number' => $faker->lexify('CHK####'),
                'add_charges' => $faker->randomNumber(2) . ' USD',
                'lot_number' => $faker->lexify('LOT#####'),
                'htnumber' => $faker->lexify('HT#####'),
                'c_remark' => $faker->sentence,
                'make' => $faker->word,
                'towed_from' => $faker->city,
                'tow_amount' => $faker->randomNumber(2) . ' USD',
                'created_by' => 1,
                'updated_by' => 1,
                'status' => $faker->randomElement(['pending', 'on_the_way', 'on_hand_with_title', 'on_hand_no_title', 'shipped']),
                'vehicle_type' => $faker->randomElement(['half-cut', 'complete']),
                'payment_date' => $faker->date(),
                'shipas' => $faker->word,
                'port_of_loading_id' => $faker->numberBetween(1, 5),
                'buyer_number' => $faker->lexify('Buyer#####'),
                'photos_link' => $faker->url,
                'storage_cost' => $faker->randomNumber(2),
                'vehicle_price' => $faker->randomNumber(4),
                'auction_fee' => $faker->randomNumber(2) . ' USD',
                'tow_amounts' => $faker->randomNumber(2),
                'dismantal_cost' => $faker->randomNumber(2),
                'ship_cost' => $faker->randomNumber(3),
                'dubai_custom_cost' => $faker->randomNumber(2),
                'dubai_storage_cost' => $faker->randomNumber(2),
                'dubai_demurage' => $faker->randomNumber(2),
                'other_cost' => $faker->randomNumber(2),
                'sales_cost' => $faker->randomNumber(3),
                'profit' => $faker->randomNumber(3),
                'percent_profit' => $faker->randomFloat(2, 1, 50) . '%',
                'auction' => $faker->word,
                'auction_city' => $faker->city,
                'title' => $faker->word,
                'pickup_due_date' => $faker->date(),
                'title_status' => $faker->word,
                'is_key' => $faker->boolean,
                'customer_note' => $faker->text,
            ]);
        }
    }
}
