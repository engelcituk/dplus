<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteServicio extends Model
{
    public $table = "clientes_servicios"; // especifico el nombre real de la tabla
    //una cliente le pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    
}
