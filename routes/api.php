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

Route::post('/register',[AuthController::class,'register']); //register
Route::post('/login',[AuthController::class,'login']); //login

Route::get('/clients',[ClientController::class,'index']);   //full index show
Route::get('/clients/{id}',[ClientController::class,'show']);   //single show
Route::get('/clients/search/{name}',[ClientController::class,'search']); //search

//protected

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class,'logout']); //logoout

    Route::post('/clients',[ClientController::class,'store']); //create
    Route::put('/clients/{id}',[ClientController::class,'update']); //update
    Route::delete('/clients/delete/{id}',[ClientController::class,'destroy']); //delete
    
}
);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
