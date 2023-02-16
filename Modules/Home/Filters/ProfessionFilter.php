<?php

namespace Modules\Home\Filters;

use App\Filters\QueryFilter;

class ProfessionFilter extends QueryFilter
{

    public function status($status)
    {
        if($status == 'all') {
            return $this->builder;
        }

        if ($status == 'on') {
            $status = 1;
        } else{
            $status = 0;
        }

        return $this->builder->where('status', $status);
    }

    public function search($str = '')
    {
        if ($str == '')
        {
            return $this->builder;
        }
        return $this->builder
            ->join('profession_translations', 'profession_translations.profession_id', '=', 'professions.id')->where('locale', 'uk')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale')
            ->where('name', 'LIKE', '%'.$str.'%');
    }

    public function category($category = '')
    {

//        dd($category);


        if ($category == 'all') {
            return $this->builder;
        }
        return $this->builder->where('category_id', $category);
    }
}
