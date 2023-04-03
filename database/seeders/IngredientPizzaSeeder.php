<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientPizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredient_pizza')->insert(
            [
                [
                    'ingredient_id' => 3,
                    'pizza_id' => 1,
                ],
                [
                    'ingredient_id' => 4,
                    'pizza_id' => 1,
                ],
                [
                    'ingredient_id' => 1,
                    'pizza_id' => 3,
                ],
                [
                    'ingredient_id' => 2,
                    'pizza_id' => 3,
                ],
                [
                    'ingredient_id' => 2,
                    'pizza_id' => 4,
                ],
            ]
        );
    }
}
