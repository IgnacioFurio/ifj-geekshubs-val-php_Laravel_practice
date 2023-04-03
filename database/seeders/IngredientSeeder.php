<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert(
            [
                [
                    'quantity' => 3,
                    'name' => 'Ternera',
                    'type' => 'Animal',
                ],
                [
                    'quantity' => 2,
                    'name' => 'Tomate',
                    'type' => 'Vegetal',
                ],
                [
                    'quantity' => 10,
                    'name' => 'Bacon',
                    'type' => 'Animal',
                ],
                [
                    'quantity' => 20,
                    'name' => 'Champiñon',
                    'type' => 'Vegetal',
                ],
            ]
        );
    }
}
