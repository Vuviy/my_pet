<?php

namespace Modules\Home\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderMenuTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title'];
}
