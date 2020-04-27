<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'name', 'category_id','description','price','commission','final_price'
    ];

    public function category() // un servicio pertenece a una categoría
    {
        return $this->belongsTo(Category::class);
    }
}
