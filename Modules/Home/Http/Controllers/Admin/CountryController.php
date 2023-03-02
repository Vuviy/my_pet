<?php

namespace Modules\Home\Http\Controllers\Admin;

use DiDom\Document;
use Modules\Home\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Home\Filters\CountryFilter;
use Modules\Parser\Contracts\IDataResource;
use function view;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CountryFilter $request)
    {

//        dd(1);
        $heads = [
            'ID',
            'Name',
            //['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $data = Country::filter($request)->get();

        $countries = [];

            foreach ($data as $country)
            {
                $li = '<i class="fa fa-lg fa-fw fa-eye"></i>';
                if($country->status == 0)
                {
                    $li = '<i class="fa fa-lg fa-fw fa-eye-slash text-red"></i>';
                }

            $btnEdit = '<a href="country/'. $country->id . '/edit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
            $btnDelete = '<button name="delete" data-id="'. $country->id .'" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
            $btnDetails = '<button name="status" data-id="'. $country->id .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">'.$li.'</button>';

            //fa-eye-slash
                //' . $country->status == 0 ? "text-red fa-eye-slash" : "fa-eye" . '
            $countryArr = [];
            $countryArr['id'] = $country->id;
            $countryArr['name'] = $country->name;
            $countryArr['btns'] = '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>';
            $countries[] = $countryArr;
        }


//            dd($countries);
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
            'status' => isset($request->status) ? 1 : 0,
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
            'cost_live' => $request->cost_live,
            'rent' => $request->rent,
            'square_meter' => $request->square_meter,
            'status' => isset($request->status) ? 1 : 0,
            'uk' => ['name' => $request->name_uk],
            'en' => ['name' => $request->name_en],
        ];
//        dd($data);

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
        $model = Country::findOrFail($id);
        $model->delete();

        return $id;
    }

    public function changeStatus($id)
    {

        $model = Country::findOrFail($id);
        $model->status = $model->status ? 0 : 1;
        $model->save();

        return $model->id;
    }

    public function loadCostLive($id, IDataResource $parser)
    {
        $country = Country::findOrFail($id);

        $data = $parser->parse($country);

        $country->fill($data)->save();

        return json_encode($data);
    }

    public function median($id)
    {
        $arr = $this->countriesIndexes($id);
        $median = $this->medianCulc($arr);

        if(!is_array($median)){
            try {
                $model = Country::findOrFail($id);
                $model->median = $median;
                $model->save();
            } catch (\Exception $e){
                return ['error' => $e->getMessage()];
            }
        }
        return $median;
    }

    public function average($id)
    {
        $arr = $this->countriesIndexes($id);
        $average = $this->averageCulc($arr);

        if(!is_array($average)){
            try {
                $model = Country::findOrFail($id);
                $model->average = $average;
                $model->save();
            } catch (\Exception $e){
                return ['error' => $e->getMessage()];
            }
        }
        return $average;
    }

    public function medianCulc($arr)
    {
        if($arr){
            $count = count($arr);
            sort($arr);
            $mid = floor(($count-1)/2);
            return ($arr[$mid]+$arr[$mid+1-$count%2])/2;
        }
        return ['error' => 'Array not exist'];
    }

    public function averageCulc($arr)
    {
        if($arr){
            $count = count($arr);
            $average = round(  array_sum($arr)/$count, 2);
            return $average;
        }
        return ['error' => 'Array not exist'];
    }

    public function countriesIndexes($id)
    {
//        $model = Country::query()
        $item = Country::findOrFail($id);

//        $items = $model->sortByDesc(function ($item){
//            $arr_index = [];
//            foreach ($item->salaries as $salary){
//                $arr_index[] = $salary->respect_index;
//            }
//            $item->median = $this->median($arr_index);
//            return $item->median;
//        });

        $arr = [];

            $sum_index = 0;
            $quantity = 0;
            $indexes = [];
            foreach ($item->salaries as $sal){
                $sum_index+= $sal->respect_index;
                $quantity++;
                $indexes[] = $sal->respect_index;
            }
//            $item->sum_index = $sum_index;
//            $item->average_index = round($sum_index/$quantity, 2);
//            $item->quantity_professions = $quantity;
//            $item->median = $this->medianC($indexes);
//            $countries[] = $item;

        return $indexes;
    }


    public function culcAllMedian()
    {
        $models = Country::all();

        foreach ($models as $country){
            try {
                $median = $this->medianCulc($this->countriesIndexes($country->id));
                $country->median = $median;
                $country->save();
            } catch (\Exception $e){
                var_dump($e);
            }
        }
        return 'OK';
    }
    public function culcAllAverage()
    {
        $models = Country::all();

        foreach ($models as $country){
            try {
                $average = $this->averageCulc($this->countriesIndexes($country->id));
                $country->average = $average;
                $country->save();
            } catch (\Exception $e){
                var_dump($e);
            }
        }

        return 'OK';
    }

}
