<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::apiResources([
//     'pizzas' => PizzaController::class,
//     'ingredients' => IngredientController::class,
// ]);
// Route::post('pizza/{pizza}/addIngredient',[PizzaController::class,'add_ingredient']);
// Route::post('pizza/{pizza}/delIngredient',[PizzaController::class,'del_ingredient']);
// Route::get('pizza/{pizza}/ingredients',[PizzaController::class,'ingredients']);

JsonApi::register('v1')->routes(function($api){
    $api->resource('pizzas');
});
