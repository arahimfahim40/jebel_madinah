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
        'role-view',
        'role-create',
        'role-edit',
        'role-delete',
       'user-view',
        'user-create',
        'user-edit',
        'user-delete',
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

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission ]);
            //Permission::create($permission);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin@gmail.com',
            'email' => 'admin@gmail.com',
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

        $this->call(VehicleSeeder::class);
    }
}
