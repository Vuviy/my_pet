<?php

namespace Modules\Home\Models;

use App\Filters\QueryFilter;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Country extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name'];

    protected $fillable = ['status', 'cost_live', 'rent', 'square_meter', 'median', 'average'];

    public function salaries()
    {
        return $this->hasMany(Salary::class)->where('status', 1)->orderBy('respect_index', 'DESC');
    }

    public function salariesForCompareCountry()
    {
        return $this->hasMany(Salary::class)->where('status', 1)->orderBy('profession_id', 'ASC');
    }
    public function salariesOrderByIndex()
    {

        return $this->hasMany(Salary::class)
            ->where('status', 1)
            ->select('*', 'profession_id as pro_id', DB::raw('(SELECT MIN(`amount`) FROM salaries WHERE profession_id = pro_id) AS min'), DB::raw('(SELECT MAX(`amount`) FROM salaries WHERE profession_id = pro_id) AS max'))
            ->orderBy('respect_index', 'DESC')
            ->limit(5);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

}
