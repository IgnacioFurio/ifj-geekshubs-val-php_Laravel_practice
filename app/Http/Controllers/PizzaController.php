<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{
    public function getallPizzas()
    {
        $pizzas = Pizza::all();

        return [
            "succes" => true,
            "data" => $pizzas
        ];
    }

    public function createPizza(Request $request)
    {
        try {
            //code...
            
            // DB::table('pizzas')->insert(
            //     [
            //         "name" => $request->input('name'),
            //         "type" => $request->input('type')
            //     ]
            // );

            $pizza = new Pizza();

            $pizza->name = $request->input('name');
            $pizza->type = $request->input('type');

            $pizza->save();

            return [
                "succes" => true,
                "data" => $pizza
            ];

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
