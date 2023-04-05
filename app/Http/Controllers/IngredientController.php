<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    public function getallIngredients()
    {
        //ToDo error handler
        $ingredients = Ingredient::all();

        return [
            "succes" => true,
            "data" => $ingredients
        ];
    }

    public function createIngredient(Request $request)
    {
        try {

            Log::info("Create Pizza");

            $validator = Validator::make($request->all(), [
                'name' => 'required | regex:/[A-Za-z0-9]+$/',
                'type' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $ingredients = new Ingredient();

            $ingredients->name = $request->input('name');
            $ingredients->type = $request->input('type');

            $ingredients->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "New pizza created",
                    "data" => $ingredients
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::error("CREATING PIZZA ".$th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "error creating pizza"
                ],
                500
            );
        }
    }

    public function updatePizza(Request $request, $id)
    {
        try {
            //code...

            $validator = Validator::make($request->all(), [
                'name' => 'required | regex:/[A-Za-z0-9]+$/',
                'type' => [
                    Rule::in(['fina', 'pan_pizza', 'original'])
                ],
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            //save info from request
            $pizza = Pizza::find($id);

            if(!$pizza){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Pizza do not exist'
                    ]
                );
            }

            $pizza->name = $request->input("name");
            $pizza->name = $request->input("type");

            //if exist and no null, set variables in pizza
            if(isset($name)){
                $pizza->name = $request->input("name");
            }

            if(isset($name)){
                $pizza->type = $request->input("type");
            }


            $pizza->save();
            

            return response()->json(
                [
                    "success" => true,
                    "message" => "Pizza updated",
                    "data" => $pizza
                ]
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

    public function deletePizza(Request $request, $id)
    {
        try {
            //code...

            Pizza::destroy($id);

            //another way
            // Pizza::query()->where('id', $id)->delete();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Seek and destroyed",
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
