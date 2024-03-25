<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CartesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});


//API route


Route::post('register' , [UserController::class , 'register']);
Route::post('login' , [UserController::class , 'login']);
Route::group([
    "middleware" => ["auth:sanctum"]

] , function(){

    Route::get('profile' , [UserController::class , 'profile']);
    Route::get('logout' , [UserController::class , 'logout']);

});


Route::apiResource('/cartes', CartesController::class);

