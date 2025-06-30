<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoryProductTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
