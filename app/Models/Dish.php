<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredients;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'cb_dishes';

    public function ingredients(){ 
        return $this->belongsToMany(Ingredients::class, 'cb_dish_ingredients', 'dish_id', 'ingredient_id')->withPivot('quantity','unit'); 
    }
}
