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
   public function index(CountryInfoFilter $filter, Request $request)
   {
       if($request->has('compare') &&  $request->has('compare_with')){
           $data = $this->compare($request);
           return view('home::country.countries', compact('data'));
       }

       $model = Country::filter($filter)->get();

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
           ->published()
           ->get();
       return response()->json($filterResult);
   }

   public function compare(Request $request)
   {

       $compare_country_name = $request->input('compare');

       if(count(explode(' ', $compare_country_name )) > 1){
           $compare_country_name = implode(' ', explode(' ', $compare_country_name ));
       }
       $compare_country = Country::query()
           ->join('country_translations', 'countries.id', '=', 'country_translations.country_id')
           ->select('countries.*', 'country_translations.name', 'country_translations.locale', DB::raw('(SELECT MIN(`rent`) FROM countries) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM countries) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM countries) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM countries) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM countries) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM countries) AS max_square_meter'))
           ->where('country_translations.name', 'LIKE', '%'. $compare_country_name. '%')
            ->where('country_translations.locale', '=', \app()->getLocale())
           ->first();


       $compare_with_name = $request->input('compare_with');

       if(count(explode(' ', $compare_with_name )) > 1){
           $compare_with_name = implode(' ', explode(' ', $compare_with_name ));
       }
       $compare_with = Country::query()
           ->join('country_translations', 'countries.id', '=', 'country_translations.country_id')
           ->select('countries.*', 'country_translations.name', 'country_translations.locale', DB::raw('(SELECT MIN(`rent`) FROM countries) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM countries) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM countries) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM countries) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM countries) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM countries) AS max_square_meter'))
           ->where('country_translations.name', 'LIKE', '%'. $compare_with_name. '%')
            ->where('country_translations.locale', '=', \app()->getLocale())
           ->first();


//       $professions = $compare_country->salaries > $compare_with->salaries ? $compare_country->salaries :$compare_with->salaries;

//       dd($compare_with);


       $pros = [];
       $compare_professions = [];
       $with_professions = [];

       foreach ($compare_country->salaries as $slary){
           $compare_professions[$slary->profession->id] = $slary;
           $pros[] = $slary->profession->id;
       }
       foreach ($compare_with->salaries as $slary){
           $with_professions[$slary->profession->id] = $slary;

           if(!in_array($slary->profession->id, $pros)){
               $pros[] = $slary->profession->id;
           }
       }

//       dd($compare_professions);

       $data = [
           'professions' => $pros,
           'countries' =>[
               'compare' => [$compare_country, $compare_professions],
               'compare_with' => [$compare_with, $with_professions],
           ]
       ];

       return $data;

   }

}
