<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::middleware('auth_api')->group(function (){

    Route::group(['prefix' =>'/countries'], function (){
        Route::get('/{id}', [\App\Http\Controllers\Api\V1\CountryController::class, 'index'])->name('country');
        Route::get('/', [\App\Http\Controllers\Api\V1\CountryController::class, 'all'])->name('countries');
    });


    Route::group(['prefix' =>'/professions'], function (){
        Route::get('/{id}', [\App\Http\Controllers\Api\V1\ProfessionController::class, 'index'])->name('profession');
        Route::get('/', [\App\Http\Controllers\Api\V1\ProfessionController::class, 'all'])->name('professions');
    });

    Route::group(['prefix' =>'/salaries'], function (){
        Route::get('/{id}', [\App\Http\Controllers\Api\V1\SalaryController::class, 'index'])->name('salary');
        Route::get('/', [\App\Http\Controllers\Api\V1\SalaryController::class, 'all'])->name('salaries');
    });
});
