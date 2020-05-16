<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    
    public function index()
    {

        return view('admin.ventas.index');
    }
    public function getClientesServicios(Request $request){
        
        $datosCliente = $request->get('datosCliente');
        
        $clientes = DB::table('cliente_television')
        ->where(function($query) use ($datosCliente){
            $query->where('clientes.name', 'like', '%'.$datosCliente.'%');
            $query->orWhere('cliente_television.referencia', 'like', '%'.$datosCliente.'%');
        })
        ->join('clientes', 'clientes.id', '=', 'cliente_television.cliente_id')
        ->select('clientes.id as idCliente','clientes.name','cliente_television.referencia')
        ->get();
    

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'llegaste aquí',
            'clientes' => $clientes,
            ]
        );

    }

}
