<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['name'];
    protected $dates = ['date_expiration'];

    // un cliente pertenece a muchas televisiones   
    public function televisions(){

        return $this->belongsToMany(Television::class)->withPivot('referencia'); 
    }

    // un cliente pertenece a muchas internet   
    public function internets(){

        return $this->belongsToMany(Internet::class)->withPivot('antenna_ip','client_ip','antenna_password','router_password','date_start', 'date_expiration'); 
    }
}
