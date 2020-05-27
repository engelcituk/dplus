<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; 
    
    // una categoria tiene muchos internets
    public function internets()
    {
        return $this->hasMany(Internet::class);
    }

    // una categoria tiene muchos televisions
    public function televisions()
    {
        return $this->hasMany(Television::class);
    }

    // una categoria tiene muchos productos
    public function products()
    {
        return $this->hasMany(Producto::class);
    }
}
