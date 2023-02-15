<?php

namespace App\Filters;

use App\Models\Country;

class SalaryFilter extends QueryFilter
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

//    public function search($str = '')
//    {
//        if ($str == '')
//        {
//            return $this->builder;
//        }
//        return $this->builder->join('salary_translations', 'salary_translations.salary_id', '=', 'salaries.id')->where('locale', 'uk')->where('name', 'LIKE', '%'.$str.'%');
//    }

    public function country($category = '')
    {
        if ($category == 'all') {
            return $this->builder;
        }
        return $this->builder->where('country_id', $category);
    }

    public function minAmount($minAmount = '')
    {
        if ($minAmount == '0') {
            return $this->builder;
        }
        return $this->builder->where('amount', '>', $minAmount);
    }

    public function maxAmount($maxAmount = '')
    {
        if ($maxAmount == '') {
            return $this->builder;
        }
        return $this->builder->where('amount', '<', $maxAmount);
    }

    public function profession($profession = '')
    {
        if ($profession == 'all') {
            return $this->builder;
        }
        return $this->builder->where('profession_id', $profession);
    }
}
