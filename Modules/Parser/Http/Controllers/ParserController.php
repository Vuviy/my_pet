<?php

namespace Modules\Parser\Http\Controllers;

use DiDom\Document;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Parser\Contracts\IDataResource;

class ParserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(IDataResource $resource)
    {

//        $document = new Document('https://www.work.ua/salary/', true);
//        $items = $document->find('a.chart-horizontal');
//
//
//        $arr = [];
//
//        foreach ($items as $item){
//            $arr[$item->first('.chart-category')->text()] = intval( preg_replace("/[^0-9]/", '',$item->first('.chart-data-digits')->text()));
//        }
//
//        file_put_contents('../Modules/Parser/Ukraine_file_'. date('Y-m-d H:m'). '.json', json_encode($arr));


//        dd($arr);

        return view('parser::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('parser::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('parser::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('parser::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
