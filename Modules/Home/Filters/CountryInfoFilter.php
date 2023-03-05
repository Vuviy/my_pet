<?php

namespace Modules\Home\Filters;

use App\Filters\QueryFilter;
use Illuminate\Support\Facades\DB;
use Modules\Home\Models\Profession;

class CountryInfoFilter extends QueryFilter
{

    public function search($id = '')
    {
//        $country = $str;
//
//        if(count(explode(' ', $country )) > 1){
//            $country = implode(' ', explode(' ', $country ));
//        }
        return $this->builder
            ->where('id', $id)
            ->select('countries.*', DB::raw('(SELECT MIN(`rent`) FROM countries) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM countries) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM countries) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM countries) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM countries) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM countries) AS max_square_meter'))
//            ->where('country_translations.locale', '=', $locale)
            ->first();
//    }
//    return $this->builder->where('id', $id)
//            ->first();
    }

//    public function compare($str = '')
//    {
//
////        dd($str);
//
//        $country = $str;
//
//        if(count(explode(' ', $country )) > 1){
//            $country = implode(' ', explode(' ', $country ));
//        }
//
//        return $this->builder
//            ->join('country_translations', 'countries.id', '=', 'country_translations.country_id')
//            ->select('countries.*', 'country_translations.name', 'country_translations.locale', DB::raw('(SELECT MIN(`rent`) FROM countries) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM countries) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM countries) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM countries) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM countries) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM countries) AS max_square_meter'))
//            ->where('country_translations.name', 'LIKE', '%'. $country. '%')
////            ->where('country_translations.locale', '=', $locale)
//            ->first();
//
//    }
//    public function compare_with($str = '')
//    {
//
////        dd($str);
//
//        $country = $str;
//
//        if(count(explode(' ', $country )) > 1){
//            $country = implode(' ', explode(' ', $country ));
//        }
//
//        return $this->builder
//            ->join('country_translations', 'countries.id', '=', 'country_translations.country_id')
//            ->select('countries.*', 'country_translations.name', 'country_translations.locale', DB::raw('(SELECT MIN(`rent`) FROM countries) AS min_rent'), DB::raw('(SELECT MAX(`rent`) FROM countries) AS max_rent'), DB::raw('(SELECT MIN(cost_live) FROM countries) AS min_cost_live'), DB::raw('(SELECT MAX(cost_live) FROM countries) AS max_cost_live'), DB::raw('(SELECT MIN(square_meter) FROM countries) AS min_square_meter'), DB::raw('(SELECT MAX(square_meter) FROM countries) AS max_square_meter'))
//            ->where('country_translations.name', 'LIKE', '%'. $country. '%')
////            ->where('country_translations.locale', '=', $locale)
//            ->first();
//
//    }

//    public function country($country = '')
//    {
//        if ($country == '') {
//            return $this->builder;
//        }
////        return $this->builder->where('country_id', $country);
//        return $this->builder
//            ->join('salaries', 'countries.id', '=', 'salaries.country_id')
//            ->select('salaries.*', 'countries.*')
//            ->where('salaries.country_id', '=', $country)
//    //            ->where('country_translations.locale', '=', $locale)
//            ->first();
//    }
}
