<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    public function getallPizzas()
    {
        //ToDo error handler
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

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $pizza = new Pizza();

            $pizza->name = $request->input('name');
            $pizza->type = $request->input('type');

            $pizza->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "New pizza created",
                    "data" => $pizza
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }
}
