<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function restaurantDishes()
    {
        return $this->hasMany(Dish::class); // jei ne per ID jungiau lenteles, tai reikia irasyti per ka jungiau, automatiskai nepagauna
    }
}
