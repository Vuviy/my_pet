<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Profession;
use App\Models\Salary;
use App\Models\Test;
use DiDom\Document;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Blog\Models\Post;
use Modules\Parser\Contracts\IDataResource;
use PhpParser\Comment\Doc;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(IDataResource $resource)
    {


//        $ch = curl_init('https://info.yavkursi.com/profi_list2');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_HEADER, false);
//        $html =curl_exec($ch);
//        curl_close($ch);

//        $countries = Country::query()->paginate(5);
        $professions = Profession::query()->paginate(5);


//        dd($countries[3]->salaries);

        return view('home::sala', compact( 'professions'));

//        foreach ($countries as $country)
//        {
//            foreach ($professions as $profession)
//            {
//                $model = new Salary();
//                $model->fill(
//                    [
//                        'amount' => random_int(50, 950),
//                        'profession_id' => $profession->id,
//                        'country_id' => $country->id,
//                    ]
//                )->save();
//            }
//        }

//        $arr = json_decode(Storage::get('modules/Ukraine_file_SAVED.json'), true);
//
//        dd($arr);
//        $resource->saveInDB();
//        Storage::delete('modules/Ukraine_file.json');
//        Storage::put('modules/Ukraine_file.json', 'dfsfsdfsd');
//        dd($resource->saveInDB());
//        echo date_default_timezone_get();
//        return view('home::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::create');
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
