<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Home\Models\Country;
use Modules\Home\Models\HeaderMenu;
use Modules\Home\Models\Profession;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('headerMenu', HeaderMenu::all());
        View::composer(['home::profession.professions', 'home::country.countries'],  function ($view){
            $view->with('countries', Country::published()->get());
            $view->with('profs', Profession::published()->get());
        });
//        View::composer(['home::profession.professions',],  function ($view){
//            $view->with('countries', Country::published()->get());
//        });
    }
}
