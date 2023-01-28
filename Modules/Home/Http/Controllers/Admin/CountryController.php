<?php

namespace Modules\Home\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function view;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

//        dd(route('country.destroy', ['country' => 4]));

        $heads = [
            'ID',
            'Name',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];


        $data = Country::all();


//        dd($data[0]->id);
        $countries = [];

            foreach ($data as $country)
            {
            $btnEdit = '<a href="country/'. $country->id . '/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $country->id .'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                           <i class="fa fa-lg fa-fw fa-eye"></i>
                       </button>';
            $countryArr = [];
            $countryArr['id'] = $country->id;
            $countryArr['name'] = $country->translation->name;
            $countryArr['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $countries[] = $countryArr;
        }

        return view('home::admin.country.index', compact('countries', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $action = 'Creating';

        return view('home::admin.country.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $data = [
            'uk' => ['name' => $request->name_uk],
            'en' => ['name' => $request->name_en],
        ];


        $country = new Country();

        $country->fill($data)->save();

        return $country->id;
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

        $model = Country::findOrFail($id);
        $action = 'Edit';

//        dd($model->translate('en')->name);
        return view('home::admin.country.form', compact('model', 'action'));
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
            'uk' => ['name' => $request->name_uk],
            'en' => ['name' => $request->name_en],
        ];

        $country = Country::findOrFail($id);

        $country->update($data);

        return $country->id;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

//        return $id.'sraka';
//        dd($id);


        dd($id);

        $model = Country::destroy($id);

        return $id;


    }
}
