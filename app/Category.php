<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

     // una categoria tiene muchos servicios
     public function servicios()
     {
         return $this->hasMany(Servicio::class);
     }
}
