<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;
use Modules\Home\Models\Country;

class BaseController extends Controller
{

    public array $orderBy_array = ['asc', 'desc','ASC', 'DESC'];

    public function index($id)
    {

        $result = new $this->resource($this->model::published()->where('id', $id)->first());

        if(!$result->resource){
            return response([class_basename($this->model).' not found'], 404);
        }

        return  $result;
    }
    public function all(Request $request)
    {

        $sort = $request->query('sort');
        if($sort && !in_array($sort, $this->sort_array)){
            return response(['Sort by "'.$sort. '" not allowed'], 404);
        }
        $order_by = $request->query('order_by');
        if($order_by && !in_array($order_by, $this->orderBy_array)){
            return response(['Order by "'.$order_by. '" not allowed'], 404);
        }
        if($sort){
            if($order_by){
                return  new $this->collection($this->model::published()->orderBy($sort, $order_by)->get());
            }
            return new $this->collection($this->model::published()->orderBy($sort)->get());
        }


        return  new $this->collection($this->model::published()->get());
    }
}
