<?php

namespace Modules\Home\Filters;

use App\Filters\QueryFilter;
use Modules\Home\Models\Profession;

class ProfessionIndexFilter extends QueryFilter
{

    public function search($id = '')
    {

//        $profesiion = $str;
//
//        if(count(explode(' ', $profesiion )) > 1){
//            $profesiion = implode(' ', explode(' ', $profesiion ));
//        }
//
//        return $this->builder
//            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
//            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
//            ->where('profession_translations.name', 'LIKE', '%'. $profesiion. '%')
////            ->where('profession_translations.locale', '=', $locale)
//            ->first();
        return $this->builder
//            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
//            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
            ->where('id', $id)
//            ->where('profession_translations.locale', '=', $locale)
            ->first();

    }

//    public function country($country = '')
//    {
//        if ($country == '') {
//            return $this->builder;
//        }
////        return $this->builder->where('country_id', $country);
//        return $this->builder
//            ->join('salaries', 'professions.id', '=', 'salaries.profession_id')
//            ->select('salaries.*', 'professions.*')
//            ->where('salaries.country_id', '=', $country)
//    //            ->where('profession_translations.locale', '=', $locale)
//            ->first();
//    }
}
