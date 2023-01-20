<?php

namespace Modules\Home\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class HeaderMenu extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;


    public $translatedAttributes = ['title'];
    protected $fillable = ['link'];
}
