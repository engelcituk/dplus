<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['name'];

    // un cliente pertenece a muchas televisiones   
    public function televisions(){

        return $this->belongsToMany(Television::class)->withPivot('referencia'); 
    }
}
