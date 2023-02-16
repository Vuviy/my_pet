<?php

namespace Modules\Home\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Home\Models\Category;
use Modules\Home\Models\HeaderMenu;
use Modules\Home\Models\Profession;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $heads = [
            'ID',
            'Link',
            'Title',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $data = HeaderMenu::all();

//        dd($data[0]);

        $menu = [];

        foreach ($data as $menuItem)
        {


            $li = '<i class="fa fa-lg fa-fw fa-eye"></i>';
            if($menuItem->status == 0)
            {
                $li = '<i class="fa fa-lg fa-fw fa-eye-slash text-red"></i>';
            }

            $btnEdit = '<a href="menu/'. $menuItem->id . '/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $menuItem->id .'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button name="status" data-id="'. $menuItem->id .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">'.$li.'</button>';

            //fa-eye-slash
            //' . $country->status == 0 ? "text-red fa-eye-slash" : "fa-eye" . '

            $menuArr = [];
            $menuArr['id'] = $menuItem->id;
            $menuArr['link'] = $menuItem->link;
            $menuArr['name'] = $menuItem->title;

            $menuArr['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $menu[] = $menuArr;
        }


        return view('home::admin.menu.index', compact('menu', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $action = 'Creating';

        return view('home::admin.menu.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = [
            'status' => isset($request->status) ? 1 : 0,
            'link' => $request->link,
            'uk' => ['title' => $request->title_uk],
            'en' => ['title' => $request->title_en],
        ];

        $profession = new HeaderMenu();

        $profession->fill($data)->save();

        return $profession->id;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $model = HeaderMenu::findOrFail($id);
        $action = 'Edit';

        return view('home::admin.menu.form', compact('model', 'action'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $data = [
            'status' => isset($request->status) ? 1 : 0,
            'link' => $request->link,
            'uk' => ['title' => $request->title_uk],
            'en' => ['title' => $request->title_en],
        ];
//        dd($data);

        $nemuItem = HeaderMenu::findOrFail($id);

        $nemuItem->update($data);

        return $nemuItem->id;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = HeaderMenu::findOrFail($id);
        $model->delete();

        return $id;
    }

    public function changeStatus($id)
    {

        $model = HeaderMenu::findOrFail($id);

        $model->status = $model->status ? 0 : 1;
        $model->save();

        return $model->id;
    }
}
