<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Television;
use App\Producto;

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
        ->select('clientes.id as idCliente', 'cliente_television.television_id as idTelevision','clientes.name','cliente_television.referencia')
        ->get();

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'respuesta',
            'clientes' => $clientes,
            ]
        );
    }

    public function getListaProductos(Request $request){
        
        $datosProducto = $request->get('datosProducto');
    
        $productos = Producto::where('description', 'like', '%' .$datosProducto. '%')->orWhere('barcode', 'like', '%' .$datosProducto. '%')->get();

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'llegaste aquí',
            'productos' => $productos,
            ]
        );
    }
    public function getDatosServicioTv(Request $request){
        $idTvServicio = $request->get('idTvServicio');

        $servicioTV = Television::find($idTvServicio); //busco el servicio de tv

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'Datos de tv',
            'servicioTV' => $servicioTV,
            ]
        );
    }

}
