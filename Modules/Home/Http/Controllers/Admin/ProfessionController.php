<?php

namespace Modules\Home\Http\Controllers\Admin;

use Modules\Home\Filters\ProfessionFilter;
use Modules\Home\Models\Category;
use Modules\Home\Models\Profession;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function view;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProfessionFilter $filter)
    {

        $heads = [
            'ID',
            'Name',
            'Category',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $data = Profession::filter($filter)->get();

//        dd($data);

        $professions = [];

        foreach ($data as $profession)
        {


            $li = '<i class="fa fa-lg fa-fw fa-eye"></i>';
            if($profession->status == 0)
            {
                $li = '<i class="fa fa-lg fa-fw fa-eye-slash text-red"></i>';
            }

            $btnEdit = '<a href="professions/'. $profession->id . '/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $profession->id .'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button name="status" data-id="'. $profession->id .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">'.$li.'</button>';

            //fa-eye-slash
            //' . $country->status == 0 ? "text-red fa-eye-slash" : "fa-eye" . '

            $professionArr = [];
            $professionArr['id'] = $profession->id;
            $professionArr['name'] = $profession->name;
//            $professionArr['category_id'] = $profession->category->name;
            $professionArr['category'] = !isset($profession->category->name) ? '---' : '<a href="category/'.$profession->category->id.'/edit'.'">'.$profession->category->name.'</a>';
//            $professionArr['category'] = $profession->category->name;

            $professionArr['btns'] = '<nobr>'.$btnEdit
//                $btnDelete
                .$btnDetails.'</nobr>';
            $professions[] = $professionArr;
        }

        $categories = Category::all();

        return view('home::admin.profession.index', compact('professions', 'heads', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $action = 'Creating';
        $categories = Category::all();

        return view('home::admin.profession.form', compact('action', 'categories'));
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
            'category_id' => $request->category != 0 ? $request->category : null,
            'uk' => ['name' => $request->name_uk],
            'en' => ['name' => $request->name_en],
        ];

        $profession = new Profession();

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



        $model = Profession::findOrFail($id);
        $categories = Category::all();
        $action = 'Edit';

//        dd($model->translate('en')->name);
        return view('home::admin.profession.form', compact('model', 'action', 'categories'));

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
        'category_id' => $request->category != 0 ? $request->category : null,
        'uk' => ['name' => $request->name_uk],
        'en' => ['name' => $request->name_en],
    ];
//        dd($data);

        $profession = Profession::findOrFail($id);

        $profession->update($data);

        return $profession->id;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $model = Profession::findOrFail($id);
        $model->delete();

        return $id;
    }

    public function changeStatus($id)
    {

        $model = Profession::findOrFail($id);

//        dd($model->status);

        $model->status = $model->status ? 0 : 1;
        $model->save();

        return $model->id;
    }
}
