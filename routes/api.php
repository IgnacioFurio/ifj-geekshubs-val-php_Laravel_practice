<?php

use App\Http\Controllers\PizzaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return view('welcome');
});

//USER
Route::get('/users', [UserController::class, "getUsers"]);
Route::post('/users', [UserController::class, "createtUser"]);
Route::put('/users', [UserController::class, "updateUser"]);
Route::delete('/users', [UserController::class, "deleteUser"]);

//PIZZAS
Route::get('/pizza', [PizzaController::class, "getAllPizzas"]);
Route::post('/pizza', [PizzaController::class, "createPizza"]);
Route::put('/pizza/{id}', [PizzaController::class, "updatePizza"]);
Route::delete('/pizza/{id}', [PizzaController::class, "deletePizza"]);