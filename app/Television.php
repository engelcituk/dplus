<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Television extends Model
{
    protected $fillable = [
        'name', 'days_periods_id','description','price','commission','final_price'
    ];

    public function periodo() // un servicio pertenece a un periodo de tiempo (tabla days_periods)
    {
        return $this->belongsTo(DaysPeriod::class,'days_periods_id'); // indico explicitamente la columna de la relacion days_periods_id tabla de servicios
    }
}
