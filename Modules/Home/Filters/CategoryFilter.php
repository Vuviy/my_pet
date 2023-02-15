<?php

namespace Modules\Home\Filters;



use App\Filters\QueryFilter;
use App\Models\Country;

class CategoryFilter extends QueryFilter
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
        return $this->builder->join('category_translations', 'category_translations.category_id', '=', 'categories.id')->where('locale', 'uk')->where('name', 'LIKE', '%'.$str.'%');
    }
}
