<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Modules\Home\Filters\CountryInfoFilter;
use Modules\Home\Models\Country;
use Modules\Home\Models\Profession;
use Modules\Home\Models\Salary;

class CountryInfoController extends Controller
{
   public function index(CountryInfoFilter $filter)
   {

//       $minMaxSalaries = Salary::query()->select(DB::raw('min(amount) as min, max(amount) as max'))->get();

       $model = Country::filter($filter)->get();


//       dd($model);

       return view('home::country.countries', compact('model'));
   }


   public function autocompleteSearch(Request $request)
   {
       $query = $request->get('query');
       $locale = App::getLocale();

       $filterResult = Country::query()
           ->join('country_translations', 'countries.id', '=', 'country_translations.country_id')
           ->select('countries.*', 'country_translations.name', 'country_translations.locale',)
           ->where('country_translations.name', 'LIKE', '%'. $query. '%')
           ->where('country_translations.locale', '=', $locale)
           ->get();
       return response()->json($filterResult);
   }

}
