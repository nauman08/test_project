<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'cb_meals';

    public function dishes(){ 
        return $this->belongsToMany(Dish::class, 'cb_meal_dishes', 'meal_id', 'dish_id')->withPivot('option');   
    }
}
