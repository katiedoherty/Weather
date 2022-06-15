<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//grabs all the items inside my database. The array tells the system which controller to use and the index is the specific function we want to use.
Route::get('/items', [ItemController::class, 'index']);

Route::prefix('/item')->group(function (){
    Route::post('/store', [ItemController::class, 'store']);//the store in the array is which function in the itemController do we want to hit when we are on 
    Route::put('/{id}', [ItemController::class, 'update']); //can grab the id that was put into url and update that id with update function
    Route::delete('/{id}',[ItemController::class, 'destroy']);
    Route::get('/{id}', [ItemController::class, 'moreInfo']);
});