<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\SalaryCollection;
use App\Http\Resources\SalaryResource;
use Modules\Home\Models\Salary;

class SalaryController extends BaseController
{
    public Salary $model;
    public $resource;
    public $collection;
    public array $sort_array = ['id', 'amount', 'respect_index',];

    public function __construct()
    {
        $this->model = new Salary();
        $this->resource = SalaryResource::class;
        $this->collection = SalaryCollection::class;
    }
}
