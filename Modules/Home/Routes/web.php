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

    Route::get('/professions', [\Modules\Home\Http\Controllers\ProfessionController::class, 'index'])->name('professions');
//    Route::get('/professions/search/{profession}', [\Modules\Home\Http\Controllers\ProfessionController::class, 'professionsSearch'])->name('professionsSearch');

    Route::get('/autocomplete-search-profession', [\Modules\Home\Http\Controllers\ProfessionController::class, 'autocompleteSearch'])->name('autocomplete-search-profession');

    Route::get('/countries', [\Modules\Home\Http\Controllers\CountryInfoController::class, 'index'])->name('countries');
    Route::get('/autocomplete-search-country', [\Modules\Home\Http\Controllers\CountryInfoController::class, 'autocompleteSearch'])->name('autocomplete-search-country');

    Route::get('/indexes', [\Modules\Home\Http\Controllers\IndexController::class, 'index'])->name('indexes');

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
    Route::post('/country/{id}/median', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'median'])->name('median');
    Route::post('/country/{id}/average', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'average'])->name('average');
    Route::post('/country/status/{id}', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'changeStatus'])->name('countryChangeStatus');
    Route::post('/country/culc_all_median', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'culcAllMedian'])->name('culcAllMedian');
    Route::post('/country/culc_all_average', [\Modules\Home\Http\Controllers\Admin\CountryController::class, 'culcAllAverage'])->name('culcAllAverage');


    Route::resource('/professions', \Modules\Home\Http\Controllers\Admin\ProfessionController::class);
    Route::post('/professions/status/{id}', [\Modules\Home\Http\Controllers\Admin\ProfessionController::class, 'changeStatus'])->name('professionChangeStatus');


    Route::resource('/menu', \Modules\Home\Http\Controllers\Admin\MenuController::class);
    Route::post('/menu/status/{id}', [\Modules\Home\Http\Controllers\Admin\MenuController::class, 'changeStatus'])->name('menuChangeStatus');


    Route::resource('/salary', \Modules\Home\Http\Controllers\Admin\SalaryController::class);
    Route::post('/salary/status/{id}', [\Modules\Home\Http\Controllers\Admin\SalaryController::class, 'changeStatus'])->name('salaryChangeStatus');
    Route::post('/salary/{id}/respect_index', [\Modules\Home\Http\Controllers\Admin\SalaryController::class, 'calculateIndex'])->name('calculateIndex');

    Route::resource('/category', \Modules\Home\Http\Controllers\Admin\CategoryController::class);
    Route::post('/category/status/{id}', [\Modules\Home\Http\Controllers\Admin\CategoryController::class, 'changeStatus'])->name('categoryChangeStatus');

});




//    Route::get('/login', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'loginForm'])->name('login_form');
//    Route::get('/register', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'registerForm'])->name('register_form');
//
//    Route::post('/login', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'login'])->name('login');
//    Route::post('/register', [\Modules\Home\Http\Controllers\Admin\HomeController::class, 'register'])->name('register');
