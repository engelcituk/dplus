<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'name', 'category_id','days_periods_id','description','price','commission','assurance','final_price'
    ];

    public function category() // un servicio pertenece a una categoría
    {
        return $this->belongsTo(Category::class);
    }
    public function periodo() // un servicio pertenece a un periodo de tiempo (tabla days_periods)
    {
        return $this->belongsTo(DaysPeriod::class,'days_periods_id'); // indico explicitamente la columna de la relacion days_periods_id tabla de servicios
    }

    //un servicio tiene muchos clientes_servicios 
    public function serviciosCliente(){

        return $this->hasMany(ClienteServicio::class);
    }
}
