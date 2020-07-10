<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'description',
        'price_cost',
        'sale_price',
        'wholesale_price',
        'has_inventory',
        'iva',
        'units',
        'minimum'
    ];
    public $timestamps = false; // para descartar las fechas created_at y updated_at

     //un producto pertenece a una categoria
     public function category()
     {
         return $this->belongsTo(Category::class);
     }
}
