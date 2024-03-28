<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Vehicle;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            Invoice::create([
                'customer_id' => $faker->numberBetween(1, 3),
                'exchange_rate' => $faker->randomFloat(4, 0, 100),
                'invoice_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'invoice_due_date' => $faker->dateTimeBetween('now', '+1 year'),
                'status' => $faker->randomElement(['pending', 'paid', 'open']),
                'discount' => $faker->randomFloat(2, 0, 100),
                'description' => $faker->sentence,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}