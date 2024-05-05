<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//    return $request->user();
//});

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'v1', 'middleware' => 'cors'], function () {


    Route::group(['prefix' => 'category'], function (){
        Route::get('', 'CategoryController@index');
        Route::get('/{category}', 'CategoryController@show');
        Route::get('/{category}/service', 'CategoryController@service');
    });

    Route::group(['prefix' => 'service'], function (){
        Route::get('', 'ServiceController@index');
        Route::get('/{service}', 'ServiceController@show');
    });

    Route::group(['prefix' => 'record'], function (){
        Route::get('', 'RecordController@index');
        Route::get('/{record}', 'RecordController@show');
        Route::post('/store', 'RecordController@store');
    });

});
