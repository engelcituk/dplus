<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    protected $fillable = [ 'folio', 'amount', 'pay_with', 'cambio', 'note'];
    protected $primaryKey = 'folio';
}
