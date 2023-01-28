<?php

namespace Modules\Home\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Profession;
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
    public function index()
    {

        $heads = [
            'ID',
            'Name',
            'Category',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
        $data = Profession::query()->select('id', 'name', 'category_id')->with('category')->get()->toArray();


//        dd($data);


        $professions = [];



            foreach ($data as $profession)
            {
                $btnEdit = '<a href="profession/edit/'.$profession['id'] . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $profession['id'] .'" class="sraka btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                           <i class="fa fa-lg fa-fw fa-eye"></i>
                       </button>';

            $profession['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $profession['category_id'] = '<a href="category/edit/'.$profession['category']['id'].'">'.$profession['category']['name'].'</a>';
            unset($profession['category']);
            $professions[] = $profession;

//            dd($profession);

        }
//        dd($professions);
        return view('home::admin.profession.index', compact('professions', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::admin.profession.form');
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
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('home::edit');
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
