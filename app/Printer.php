<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    protected $fillable = [
        'name', 'ip'
    ];
    public $timestamps = false; // para descartar las fechas en la tabla created_at y updated_at
    
}
