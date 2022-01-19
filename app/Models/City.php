<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Country;

class City extends Model
{
    use HasFactory;

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
