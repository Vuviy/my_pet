<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{

    public function index()
    {
        return view('home::index.indexes');
    }

}