<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function deletePhoto()
    {
        if($this->photo){
            $fileName = $this->photo;
            unlink(public_path().$fileName);
            $this->photo = null;
            $this->save();
        }
    }

    public function dishRestaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
