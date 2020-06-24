<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Television extends Model
{
    protected $fillable = [
        'name','code','category_id','days_periods_id','description','price','commission','final_price'
    ];

    public function periodo() // un servicio pertenece a un periodo de tiempo (tabla days_periods)
    {
        return $this->belongsTo(DaysPeriod::class,'days_periods_id'); // indico explicitamente la columna de la relacion days_periods_id tabla de servicios
    }
    // un tv pertenece a muchos clientes
    public function clientes(){

        return $this->belongsToMany(Cliente::class);
    }
    //un servicio de television pertenece a una categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
