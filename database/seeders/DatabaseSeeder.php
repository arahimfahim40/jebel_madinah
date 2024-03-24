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

        $this->call(VehicleSeeder::class);
       
    }
}