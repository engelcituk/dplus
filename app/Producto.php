<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'name','shared_name','ip','available','default', 'use_mode'
    ];
    public $timestamps = false; // para descartar las fechas en la tabla created_at y updated_at
}
