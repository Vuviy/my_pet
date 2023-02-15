<?php

namespace App\Filters;

use App\Models\Country;

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
        return $this->builder->join('profession_translations', 'profession_translations.profession_id', '=', 'professions.id')->where('locale', 'uk')->where('name', 'LIKE', '%'.$str.'%');
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
