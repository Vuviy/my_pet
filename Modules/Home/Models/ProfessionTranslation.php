<?php

namespace Modules\Home\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionTranslation extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['name', 'locale', 'profession_id'];
}
