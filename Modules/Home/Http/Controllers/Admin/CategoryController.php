<?php

namespace Modules\Home\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Home\Filters\CategoryFilter;
use Modules\Home\Models\Category;
use function view;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CategoryFilter $filter)
    {
        $heads = [
            'ID',
            'Name',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

//        $data = Category::query()->select('id', 'name', 'status')->get()->toArray();
//        $data = Category::filter($filter)->get();
        $data = Category::filter($filter)->get();


//        dd($data[0]->id);
        $categories = [];

        foreach ($data as $category)
        {

//            dd($category->translation->name);

            $li = '<i class="fa fa-lg fa-fw fa-eye"></i>';
            if($category->status == 0)
            {
                $li = '<i class="fa fa-lg fa-fw fa-eye-slash text-red"></i>';
            }

            $btnEdit = '<a href="category/'. $category->id . '/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $category->id .'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button name="status" data-id="'. $category->id .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">'.$li.'</button>';

            //fa-eye-slash
            //' . $country->status == 0 ? "text-red fa-eye-slash" : "fa-eye" . '
            $categoryArr = [];
            $categoryArr['id'] = $category->id;
            $categoryArr['name'] = $category->name;
            $categoryArr['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $categories[] = $categoryArr;
        }

        return view('home::admin.category.index', compact('categories', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $action = 'Creating';

        return view('home::admin.category.form', compact('action'));    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = [
            'status' => isset($request->status) ? 1 : 0,
            'uk' => ['name' => $request->name_uk],
            'en' => ['name' => $request->name_en],
        ];


        $category = new Category();

        $category->fill($data)->save();

        return $category->id;
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
        $model = Category::findOrFail($id);
        $action = 'Edit';

//        dd($model->translate('en')->name);
        return view('home::admin.category.form', compact('model', 'action'));
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
            'uk' => ['name' => $request->name_uk],
            'en' => ['name' => $request->name_en],
        ];
//        dd($data);

        $category = Category::findOrFail($id);

        $category->update($data);

        return $category->id;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = Category::findOrFail($id);
        $model->delete();

        return $id;
    }


    public function changeStatus($id)
    {

        $model = Category::findOrFail($id);

//        dd($model->status);

        $model->status = $model->status ? 0 : 1;
        $model->save();

        return $model->id;
    }
}
