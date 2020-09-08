<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    protected $fillable = [
       'code','category_id','description','price','commission', 'iva','final_price'
    ];
    public $timestamps = false; // para descartar las fechas created_at y updated_at

     //un producto pertenece a una categoria
     public function category()
     {
         return $this->belongsTo(Category::class);
     }

     

}
