<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                'quantity' => 'required',
                'name' => 'required | regex:/[A-Za-z0-9]+$/',
                'type' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $ingredients = new Ingredient();

            $ingredients->name = $request->input('quantity');
            $ingredients->name = $request->input('name');
            $ingredients->type = $request->input('type');

            $ingredients->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "New Ingredient created",
                    "data" => $ingredients
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::error("CREATING INGREDIENT ".$th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "error creating ingredient"
                ],
                500
            );
        }
    }

    public function updateIngredient(Request $request, $id)
    {
        try {
            //code...

            $validator = Validator::make($request->all(), [
                'quantity' => 'required',
                'name' => 'required | regex:/[A-Za-z0-9]+$/',
                'type' => [
                    Rule::in(['animal', 'vegetal'])
                ],
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            //save info from request
            $ingredients = Ingredient::find($id);

            if(!$ingredients){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Ingredient do not exist'
                    ]
                );
            }

            $ingredients->quantity = $request->input("quantity");
            $ingredients->name = $request->input("name");
            $ingredients->type = $request->input("type");

            //if exist and no null, set variables in pizza
            if(isset($name)){
                $ingredients->quantity = $request->input("quantity");
            }

            if(isset($name)){
                $ingredients->name = $request->input("name");
            }

            if(isset($name)){
                $ingredients->type = $request->input("type");
            }


            $ingredients->save();
            

            return response()->json(
                [
                    "success" => true,
                    "message" => "Ingredient updated",
                    "data" => $ingredients
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

    public function deleteIngredient(Request $request, $id)
    {
        try {
            //code...

            Ingredient::destroy($id);

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
