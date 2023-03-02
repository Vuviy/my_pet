<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Home\Models\Country;

class IndexController extends Controller
{

    public function index()
    {
        $countriesSortByMedianDesc = Country::query()
            ->published()
            ->select('*' , 'id as ide', DB::raw('(SELECT SUM(`respect_index`) FROM salaries WHERE country_id = ide) AS sum_index'))
            ->orderBy('median', 'DESC')
            ->limit(5)
            ->get();

        return view('home::index.indexes', compact('countriesSortByMedianDesc'));
    }

    public function countryIndex()
    {
        $countries = Country::query()
            ->published()
            ->get();

        return $countries;
    }

}
