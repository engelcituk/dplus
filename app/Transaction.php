<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transactionable() {

        return $this->morpTo();
    }
    //una transaction pertenece a una cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    //una transaction lo hace un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
