<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CuisineController;
use App\Http\Controllers\Api\RestaurantController;
use App\Models\Cuisine;
use App\Models\Restaurant;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('restaurant', RestaurantController::class);
    Route::post('restaurant/{restaurant}/attach-cuisine', [RestaurantController::class, 'attachCuisine']);

    Route::apiResource('cuisine', CuisineController::class);
    Route::post('cuisine/{cuisine}/attach-restaurant', [CuisineController::class, 'attachRestaurant']);


});
