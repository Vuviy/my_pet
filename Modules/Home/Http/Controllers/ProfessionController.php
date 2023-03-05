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

        if($request->has('amount') &&  $request->has('country')){
            $culc_res = $this->culc($request);
//            dd($data);

            return view('home::profession.professions', compact('culc_res'));
        }

        $result = Profession::filter($filter)->published()->get();
//        dd($result);

        return view('home::profession.professions', compact('result'));
    }

//    public function professionsSearch(Request $request)
//    {
//
//        $profesiion = $request->profession;
//
//        if(count(explode(' ', $profesiion )) > 1){
//            $profesiion = implode(' ', explode(' ', $profesiion ));
//        }
////        dd($profesiion);
//
////        $locale = App::getLocale();
//
//        $result = Profession::query()
//            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
//            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
//            ->where('profession_translations.name', 'LIKE', '%'. $profesiion. '%')
////            ->where('profession_translations.locale', '=', $locale)
//            ->first();
//
//        if (!$result){
//            $result = [];
//        }
//
////        dd($result->salaries[0]->country->translate('en')->name);
//
//
//
//        return view('home::profession.professions', compact('result'));
//
//    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $locale = App::getLocale();

        $filterResult = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
            ->where('profession_translations.name', 'LIKE', '%'. $query. '%')
            ->where('profession_translations.locale', '=', $locale)
            ->published()
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
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale')
            ->where('profession_translations.name', 'LIKE', '%'. $compare_profession_name. '%')
//            ->where('profession_translations.locale', '=', \app()->getLocale())
            ->published()
            ->first();


        $compare_with_name = $request->input('compare_with');

        if(count(explode(' ', $compare_with_name )) > 1){
            $compare_with_name = implode(' ', explode(' ', $compare_with_name ));
        }
        $compare_with = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale')
            ->where('profession_translations.name', 'LIKE', '%'. $compare_with_name. '%')
//            ->where('profession_translations.locale', '=', \app()->getLocale())
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

        return $data;

    }

    public function culc(Request $request)
    {
//        $country_name = $request->input('country');

//        if(count(explode(' ', $country_name )) > 1){
//            $country_name = implode(' ', explode(' ', $country_name ));
//        }
//        $country = Country::query()
//            ->join('country_translations', 'countries.id', '=', 'country_translations.country_id')
//            ->select('countries.*', 'country_translations.name', 'country_translations.locale')
//            ->where('country_translations.name', 'LIKE', '%'. $country_name. '%')
////            ->where('country_translations.locale', '=', \app()->getLocale())
//            ->published()
//            ->first();

        $country = Country::findOrFail($request->input('country'));


        $amount = intval($request->input('amount'));

        $index = $this->calculateIndex($country->id, $amount);

        $countries = Country::where('id', '!=', $country->id)->get();
        $indexes = [];

        foreach ($countries as $item){
            $indexes[$item->id] = ['index' => $this->calculateIndex($item->id, $amount), 'country' => $item];
        }

        $same = [];

        foreach ($indexes as $item){
            if($item['index'] <= $index*1.3 && $item['index'] >= $index*0.7){
                $same[] =   $item;
            }
        }

        $worst = array_slice($this->array_sort($indexes, 'index'), 0, 4);
        $best_arr = array_slice($this->array_sort($indexes, 'index', SORT_DESC), 0, 4);
        $best = [];

        foreach ($best_arr as $item){
            if($item['index'] >= $index*0.8){
                $best[] =   $item;
            }
        }


        $data = [
            'current_country' => $country,
            'index' => $index,
            'worst' => $worst,
            'best' => $best,
            'same' => $same,
        ];
        return $data;
    }



    public function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

    public function calculateIndex($id, $amount)
    {

        $country = Country::findOrFail($id);

        $cost_live = $country->cost_live;
        $rent = $country->rent;
        $square_meter = $country->square_meter;

        if(!$cost_live || !$rent || !$square_meter){
            $error = 'Hevent cost live parameters';
            return new \Exception($error);
        }

        $respect_index = round($amount/($cost_live + $rent + (0.3*$square_meter)), 3);


        return $respect_index;
    }

}
