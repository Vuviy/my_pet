<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Home\Models\Profession;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function professions(Request $request)
    {
        if ($request->has('profession') && $request->profession != ''){
            return $this->professionsSearch($request);
        }
        return view('home::profession.professions');
    }

    public function professionsSearch(Request $request)
    {

        $profesiion = $request->profession;

        if(count(explode(' ', $profesiion )) > 1){
            $profesiion = implode(' ', explode(' ', $profesiion ));
        }
//        dd($profesiion);

//        $locale = App::getLocale();

        $result = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
            ->where('profession_translations.name', 'LIKE', '%'. $profesiion. '%')
//            ->where('profession_translations.locale', '=', $locale)
            ->first();

        if (!$result){
            $result = [];
        }

//        dd($result->salaries[0]->country->translate('en')->name);



        return view('home::profession.professions', compact('result'));

    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $locale = App::getLocale();

        $filterResult = Profession::query()
            ->join('profession_translations', 'professions.id', '=', 'profession_translations.profession_id')
            ->select('professions.*', 'profession_translations.name', 'profession_translations.locale',)
            ->where('profession_translations.name', 'LIKE', '%'. $query. '%')
            ->where('profession_translations.locale', '=', $locale)
            ->get();
        return response()->json($filterResult);
    }

    public function countries()
    {
        return view('home::profession.countries');
    }

    public function indexes()
    {
        return view('home::profession.index');
    }

}
