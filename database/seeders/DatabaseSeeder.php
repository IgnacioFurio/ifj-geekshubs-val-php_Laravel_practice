<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            RoleSeeder::class,
        ]);
        \App\Models\User::factory(100)->create();
        $this->call([
            PizzaSeeder::class,
            IngredientSeeder::class,
            IngredientPizzaSeeder::class,
        ]);
        \App\Models\Review::factory(1000)->create();

    }
}
