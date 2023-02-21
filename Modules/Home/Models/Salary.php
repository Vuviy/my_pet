<?php

namespace Modules\Home\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'profession_id', 'country_id', 'status'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

//    public function scopePublished($query)
//    {
//        return $query->where('status', 1);
//    }
}
