<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        $this->call( [

            //if i want to assign all role to default user then i have to use RolePermissionSeeder first then i have to use UserSeeder class
            RolePermissionSeeder::class,
            UserSeeder::class,

        ] );
    }
}
