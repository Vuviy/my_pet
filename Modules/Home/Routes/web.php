<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::get('/', 'HomeController@index')->name('home');

});

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => 'auth',
    ], function(){

//    Auth::routes();

    Route::get('/', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

    Route::resource('/country', \Modules\Home\Http\Controllers\Admin\CountryController::class);
    Route::post('/country/{id}/load_cost_live', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'loadCostLive'])->name('loadCostLive');
    Route::post('/country/status/{id}', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'changeStatus'])->name('countryChangeStatus');


    Route::resource('/professions', \Modules\Home\Http\Controllers\Admin\ProfessionController::class);
    Route::post('/professions/status/{id}', [\Modules\Home\Http\Controllers\Admin\ProfessionController::class, 'changeStatus'])->name('professionChangeStatus');


    Route::resource('/salary', \Modules\Home\Http\Controllers\Admin\SalaryController::class);
    Route::post('/salary/status/{id}', [\Modules\Home\Http\Controllers\Admin\SalaryController::class, 'changeStatus'])->name('salaryChangeStatus');

    Route::resource('/category', \Modules\Home\Http\Controllers\Admin\CategoryController::class);
    Route::post('/category/status/{id}', [\Modules\Home\Http\Controllers\Admin\CategoryController::class, 'changeStatus'])->name('categoryChangeStatus');


});




//    Route::get('/login', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'loginForm'])->name('login_form');
//    Route::get('/register', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'registerForm'])->name('register_form');
//
//    Route::post('/login', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'login'])->name('login');
//    Route::post('/register', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'register'])->name('register');
