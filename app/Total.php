<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    protected $fillable = [ 'folio','iva', 'subtotal','total', 'pay_with', 'cambio', 'note'];
    protected $primaryKey = 'folio';
    //public $incrementing = false;
    
    // una total tiene muchos transacciones
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
