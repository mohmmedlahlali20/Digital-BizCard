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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});


//API route


Route::post('register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::get('logout', [UserController::class, 'logout']);
});


Route::middleware('auth:sanctum')->group(function () {
  Route::get('/cartes', [CartesController::class, 'index'])->name('cartes.index');
  Route::post('/cartes', [CartesController::class, 'store'])->name('cartes.store');
  Route::get('/cartes/{carte}', [CartesController::class, 'show'])->name('cartes.show');
  Route::patch('/cartes/{carte}', [CartesController::class, 'update'])->name('cartes.update'); // Enclose 'update' within quotes
  Route::delete('/cartes/{carte}', [CartesController::class, 'destroy'])->name('cartes.destroy');
});



