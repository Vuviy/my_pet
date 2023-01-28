<?php

namespace Modules\Home\Http\Controllers\Admin;

use App\Models\Profession;
use App\Models\Salary;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function view;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $heads = [
            'ID',
            'Amount',
            'Profession',
            'Country',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                           <i class="fa fa-lg fa-fw fa-eye"></i>
                       </button>';

        $data = Salary::query()->select('id', 'amount', 'profession_id', 'country_id')->with('country', 'profession')->get()->toArray();


        $salaries = [];
        foreach ($data as $salary)
        {
            $salary['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $salary['country_id'] = '<a href="country/edit/'.$salary['country']['id'].'">'.$salary['country']['name'].'</a>';
            $salary['profession_id'] = '<a href="country/edit/'.$salary['profession']['id'].'">'.$salary['profession']['name'].'</a>';
            unset($salary['country']);
            unset($salary['profession']);
            $salaries[] = $salary;
        }
        return view('home::admin.salary.index', compact('salaries', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::admin.salary.form');
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
