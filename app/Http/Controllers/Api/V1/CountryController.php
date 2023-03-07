<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;
use Modules\Home\Models\Country;

class CountryController extends BaseController
{

    public Country $model;
    public $resource;
    public $collection;
    public array $sort_array = ['id', 'median', 'cost_live', 'average', 'rent', 'square_meter',];

    public function __construct()
    {
        $this->model = new Country();
        $this->resource = CountryResource::class;
        $this->collection = CountryCollection::class;
    }

}
