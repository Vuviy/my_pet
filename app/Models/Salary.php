<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'profession_id', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
