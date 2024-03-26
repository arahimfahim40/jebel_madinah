<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
      /**
     * List of applications to add.
     */

     private $permissions = [
        ["name"=>"dashboard-view","group_name"=>"dashboard"],
        ["name"=>"permission-view","group_name"=>"permission"],
        ["name"=>"role-view","group_name"=>"role"],
        ["name"=>"role-create","group_name"=>"role"],
        ["name"=>"role-edit","group_name"=>"role"],
        ["name"=>"role-delete","group_name"=>"role"],

        ["name"=>"user-view","group_name"=>"user"],
        ["name"=>"user-create","group_name"=>"user"],
        ["name"=>"user-edit","group_name"=>"user"],
        ["name"=>"user-delete","group_name"=>"user"],

        ["name"=>"customer-view","group_name"=>"customer"],
        ["name"=>"customer-create","group_name"=>"customer"],
        ["name"=>"customer-edit","group_name"=>"customer"],
        ["name"=>"customer-delete","group_name"=>"customer"],

        ["name"=>"vehicle-view","group_name"=>"vehicle"],
        ["name"=>"vehicle-create","group_name"=>"vehicle"],
        ["name"=>"vehicle-change-status","group_name"=>"vehicle"],
        ["name"=>"vehicle-edit","group_name"=>"vehicle"],
        ["name"=>"vehicle-delete","group_name"=>"vehicle"],
        ["name"=>"vehicle-summary","group_name"=>"vehicle"],

        ["name"=>"invoice-view","group_name"=>"invoice"],
        ["name"=>"invoice-create","group_name"=>"invoice"],
        ["name"=>"invoice-change-status","group_name"=>"invoice"],
        ["name"=>"invoice-edit","group_name"=>"invoice"],
        ["name"=>"invoice-delete","group_name"=>"invoice"],
        
        ["name"=>"location-view","group_name"=>"location"],
        ["name"=>"location-create","group_name"=>"location"],
        ["name"=>"location-edit","group_name"=>"location"],
        ["name"=>"location-delete","group_name"=>"location"],
    ];
   

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $faker = Factory::create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(TimeZonesSeeder::class);

        foreach ($this->permissions as $permission) {
            Permission::create( $permission );
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin@gmail.com',
            'email' => 'admin@gmail.com',
            'time_zone_id' => '1',
            'password' => Hash::make('password')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
        
        $user->assignRole([$role->id]);

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

        $this->call(InvoiceSeeder::class);
        $this->call(VehicleSeeder::class);
       
    }
}