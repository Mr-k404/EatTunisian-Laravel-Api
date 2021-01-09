<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
class Recipe extends Model
{
    protected $fillable = [
        'name', 'cookTime', 'instractions', 'servings', 'rate', 'image', 'category'
    ];
    
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot(['amont', 'unit']);
    }
}
