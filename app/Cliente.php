<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['name'];

     //un cliente tiene muchos servicios 
     public function clienteServicios(){

        return $this->hasMany(ClienteServicio::class,'cliente_id');
    }
}
