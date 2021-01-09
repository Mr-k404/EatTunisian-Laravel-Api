<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class Ingredient extends Model
{
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withPivot('amont', 'unit');
    }
}
