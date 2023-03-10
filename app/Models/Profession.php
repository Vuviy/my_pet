<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;

    public $translatedAttributes = ['name', 'locale'];
    protected $fillable = ['status', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
