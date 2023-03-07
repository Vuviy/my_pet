<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ProfessionCollection;
use App\Http\Resources\ProfessionResource;
use Modules\Home\Models\Profession;

class ProfessionController extends BaseController
{

    public Profession $model;
    public $resource;
    public $collection;
    public array $sort_array = ['id', 'category_id'];


    public function __construct()
    {
        $this->model = new Profession();
        $this->resource = ProfessionResource::class;
        $this->collection = ProfessionCollection::class;
    }
}
