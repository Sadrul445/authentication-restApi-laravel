<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
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

//public 

Route::post('/register',[AuthController::class,'register']);


Route::get('/clients',[ClientController::class,'index']);
Route::get('/clients/{id}',[ClientController::class,'show']);

Route::post('/clients',[ClientController::class,'store']);
Route::post('/clients/{id}',[ClientController::class,'update']);
Route::delete('/clients/delete/{id}',[ClientController::class,'destroy']);
Route::get('/clients/search/{name}',[ClientController::class,'search']);

//protected

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
