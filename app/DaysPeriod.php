<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaysPeriod extends Model
{
    protected $fillable = [
        'days_number', 'description'
    ];

    // una periodo de dias tiene muchos servicios
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
