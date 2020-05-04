<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['name'];

    public function skys(){ 

        return $this->belongsToMany(Servicio::class);
    }
}
