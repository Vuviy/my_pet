<?php

namespace App\Filters;

use App\Models\Country;

class CountryFilter extends QueryFilter
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
        return $this->builder->join('country_translations', 'country_translations.country_id', '=', 'countries.id')->where('locale', 'uk')->where('name', 'LIKE', '%'.$str.'%');
    }
}
