<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Television;
use App\Producto;
use App\Cliente;
use App\Transaction;
use App\Total;

class VentasController extends Controller
{
    
    public function index()
    {
        $tvServicios = Television::all();

        return view('admin.ventas.index', compact('tvServicios'));
    }
    public function getClientesServicios(Request $request){
    
        $datosCliente = $request->get('datosCliente');
    
        $clientes = DB::table('cliente_television')
        ->where(function($query) use ($datosCliente){
            $query->where('clientes.name', 'like', '%'.$datosCliente.'%');
            $query->orWhere('cliente_television.referencia', 'like', '%'.$datosCliente.'%');
        })
        ->join('clientes', 'clientes.id', '=', 'cliente_television.cliente_id')
        ->join('televisions', 'televisions.id', '=', 'cliente_television.television_id')
        ->select('clientes.id as idCliente', 'cliente_television.television_id as idTelevision','televisions.code as code','clientes.name','cliente_television.referencia')
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
    
        $productos = Producto::where('description', 'like', '%' .$datosProducto. '%')->orWhere('code', 'like', '%' .$datosProducto. '%')->get();

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
    public function getDataCliente(Request $request){
        $idCliente = $request->get('id');

        $cliente = Cliente::with('televisions')->find($idCliente); //obtengo el cliente y los datos de su servicio de tv mediante su relacion
        if ($cliente ) {
            $ok=true;
            $mensaje = 'cliente encontrado';
            $objeto = $cliente;
        } else {
           $ok=false;
           $mensaje = 'cliente no se encuentra';
           $objeto = [];
        }
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje,
            'cliente' => $objeto,
            ]
        );
    }
    public function saveCliente(Request $request)
    {
        $nombreCliente = trim(ucwords($request->get('name'),' '));

        $respuestaCliente = Cliente::where('name', $nombreCliente)->get();// busco en la tabla sino existe el cliente con ese nombre
        $formData = array('name'=>$nombreCliente); //array con los campos para el cliente
        
        if(count($respuestaCliente) > 0){// si el cliente existe actuaizo sus datos de tv servicio
            Cliente::whereId($respuestaCliente[0]->id)->update($formData);//actualizo, aunque no es necesario
            $cliente = Cliente::find($respuestaCliente[0]->id);
            // detach y attach de servicios de TV            
            $cliente->televisions()->detach();
            $cliente->televisions()->attach($request->get('television_id'),['referencia'=>$request->get('referencia')]);
            //respuesta
            $ok=true;
            $mensaje = 'cliente ya registrado y actualizado';
            $objeto = $cliente;
        }else {

            $cliente = Cliente::create($formData); // retorno el objeto cliente
            $cliente->televisions()->detach();
            $cliente->televisions()->attach($request->get('television_id'),['referencia'=>$request->get('referencia')]);

            $ok=true;
            $mensaje = 'cliente se registró y se le agrega su servicio de tv';
            $objeto = [];
        }

        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje,
            'cliente' => $objeto,
            ]
        );
    }
    public function updateCliente(Request $request)
    {
        $nombreCliente = trim(ucwords($request->get('name'),' '));
        $idCliente = $request->get('id');

        $formData = array('name'=>$nombreCliente); //array con los campos para el cliente
        
        Cliente::whereId($idCliente)->update($formData);//actualizo, aunque no es necesario
        $cliente = Cliente::find($idCliente);
        // detach y attach de servicios de TV            
        $cliente->televisions()->detach();
        $cliente->televisions()->attach($request->get('television_id'),['referencia'=>$request->get('referencia')]);
        //respuesta
        $ok=true;
        $mensaje = 'Los datos del cliente han sido actualizados';
        $objeto = $cliente;
    
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje,
            'cliente' => $objeto,
            ]
        );
    }
    public function cobrar(Request $request)
    {
        $items = $request->get('items'); //array de productos y o servicios
        $cabecera = $request->get('cabecera');
        $necesitaTicket = $request->get('necesitaTicket');

        foreach($items as $data){ // recorro el array y voy construyendo la estructura de la tabla de transacciones
            $transaction = new Transaction([
                'folio' => $data['folio'],
                'code' => $data['codigo'],
                'user_id' => $data['idUsuario'],
                'cliente_id' => $data['idCliente'],
                'transactionable_type' => $data['transactionable_type'],
                'transactionable_id' => $data['transactionable_id'],
                'description' => $data['descripcion'],
                'name_cliente' => $data['nombreCliente'],
                'reference' => $data['referencia'],
                'quantity' => $data['cantidad'],
                'price' => $data['precio'],
                'commission' => $data['comision'],
                'provider_payment_number' => $data['numPagoProveedor'],
                'provider_authorization_number' => $data['numAutorizacionProveedor'],
                'note' => $data['nota']
            ]);

            $transaction->save(); // guardo
        }
        if($necesitaTicket){// si necesita ticket se manda a ticket de impresoras

        }
        $formData  = array(
            'folio' => $cabecera['folio'],
            'amount' => $cabecera['importe'],
            'pay_with' => $cabecera['pagaCon'],
            'cambio' => $cabecera['cambio'],
            'note' => $cabecera['nota']
        );

       Total::create($formData); // creo el registro de los totales de la venta

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'Cobro realizado exitosamente'
            ]
        );

    }
}
