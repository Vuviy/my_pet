<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Home\Filters\ProfessionIndexFilter;
use Modules\Home\Models\Country;
use Modules\Home\Models\Profession;
use Modules\Home\Models\Salary;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProfessionIndexFilter $filter, Request $request)
    {
//        if ($request->has('profession') && $request->profession != ''){
//            return $this->professionsSearch($request);
//        }

        if($request->has('compare') &&  $request->has('compare_with')){
            $data = $this->compare($request);
//            dd($data);

            return view('home::profession.professions', compact('data'));
        }

        $result = Profession::filter($filter)->published()->get();
//        dd($result);

        return view('home::profession.professions', compact('result'));
    }

    public function professionsSearch(Request $request)
    {

        $profesiion = $request->profession;

        if(count(explode(' ', $profesiion )) > 1){
            $profesiion = implode(' ', explode(' ', $profesiion ));
        }
//        dd($profesiion);

//        $locale = App::getLocale();

        $result = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
            ->where('profession_translations.name', 'LIKE', '%'. $profesiion. '%')
//            ->where('profession_translations.locale', '=', $locale)
            ->first();

        if (!$result){
            $result = [];
        }

//        dd($result->salaries[0]->country->translate('en')->name);



        return view('home::profession.professions', compact('result'));

    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $locale = App::getLocale();

        $filterResult = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
            ->where('profession_translations.name', 'LIKE', '%'. $query. '%')
            ->where('profession_translations.locale', '=', $locale)
            ->get();
        return response()->json($filterResult);
    }

    public function professions()
    {
        return view('home::profession.professions');
    }

    public function indexes()
    {
        return view('home::profession.index');
    }


    public function compare(Request $request)
    {

        $compare_profession_name = $request->input('compare');

        if(count(explode(' ', $compare_profession_name )) > 1){
            $compare_profession_name = implode(' ', explode(' ', $compare_profession_name ));
        }
        $compare_profession = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
//            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale', DB::raw('(SELECT MIN(`rent`) FROM professions) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM professions) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM professions) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM professions) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM professions) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM professions) AS max_square_meter'))
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale')
            ->where('profession_translations.name', 'LIKE', '%'. $compare_profession_name. '%')
            ->where('profession_translations.locale', '=', \app()->getLocale())
            ->published()
            ->first();


        $compare_with_name = $request->input('compare_with');

        if(count(explode(' ', $compare_with_name )) > 1){
            $compare_with_name = implode(' ', explode(' ', $compare_with_name ));
        }
        $compare_with = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
//            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale', DB::raw('(SELECT MIN(`rent`) FROM professions) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM professions) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM professions) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM professions) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM professions) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM professions) AS max_square_meter'))
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale')
            ->where('profession_translations.name', 'LIKE', '%'. $compare_with_name. '%')
            ->where('profession_translations.locale', '=', \app()->getLocale())
            ->published()
            ->first();


//       $professions = $compare_country->salaries > $compare_with->salaries ? $compare_country->salaries :$compare_with->salaries;

//       dd($compare_with);


        $countries = [];
        $compare_countries = [];
        $with_countries = [];

        foreach ($compare_profession->salaries as $slary){
            $compare_countries[$slary->country->id] = $slary;
            $countries[$slary->country->id] = $slary->country;
        }
        foreach ($compare_with->salaries as $slary){
            $with_countries[$slary->country->id] = $slary;
            if(!in_array($slary->country->id, array_keys($countries))){
                $countries[$slary->country->id] = $slary->country;
            }
        }

//        dump($compare_countries);
//        echo '<br>';
//        dump($with_countries);
//       dd($countries);

        $data = [
            'countries' => $countries,
            'professions' =>[
                'compare' => [$compare_profession, $compare_countries],
                'compare_with' => [$compare_with, $with_countries],
            ]
        ];

//        $data[] = $compare_profession;
//        $data[] = $compare_with;
        return $data;

    }

}
