<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [ 'folio', 'code', 'user_id', 'cliente_id', 'transactionable_type', 'transactionable_id', 'description', 'name_cliente', 'reference', 'quantity', 'price', 'commission', 'provider_payment_number', 'provider_authorization_number', 'note' 
    ];

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
