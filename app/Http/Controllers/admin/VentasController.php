<?php

namespace App\Http\Controllers\admin;
//para usar impresoras por nombre compartido
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Television;
use App\Producto;
use App\Cliente;
use App\Transaction;
use App\Total;
use App\Printer as MiniPrinter; // con alias porque choca con la clase de la librería de mike42

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
        ->select('clientes.id as idCliente', 'cliente_television.television_id as idTelevision','televisions.code as code','televisions.iva as iva','clientes.name','cliente_television.referencia')
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
        $cabecera = $request->get('cabecera');
        $items = $request->get('items'); //array de productos y o servicios
        $necesitaTicket = $request->get('necesitaTicket');

        $formData  = array(
            'folio' => $cabecera['folio'],
            'iva' => $cabecera['iva'],
            'subtotal' => $cabecera['subTotal'],
            'total' => $cabecera['total'],
            'pay_with' => $cabecera['pagaCon'],
            'cambio' => $cabecera['cambio'],
            'note' => $cabecera['nota']
        );

       Total::create($formData); // creo el registro de los totales de la venta
       
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
            $printer = MiniPrinter::where('available', 1)->Where('default',1)->first();//get first miniprinter available and default
            if($printer){ // si hay impresora, mando a imprimir
                $modoUso = $printer['use_mode']; // se obtiene el tipo de impresora
                if ($modoUso == 'usb/compartido') {// si por compartido usb, se manda a esa impresora
                    $this->imprimeTicketPorUsbCompartido($printer,$cabecera,$items);
                } elseif ($modoUso == 'red/ip') {//si es por red
                    // $this->imprimeTicketPorIpRed($printer,$cabecera,$items);
                }
            }
        }
        
        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'Cobro realizado exitosamente'
            ]
        );
    }

    public function imprimeTicketPorUsbCompartido($printer,$cabecera,$items)
    {
        $namePrinterUsbShared = $printer['shared_name'];
        $folio = $cabecera['folio'];
        $user = auth()->user();

        try {
            
            $connector = new WindowsPrintConnector($namePrinterUsbShared);
            
            $printer = new Printer($connector);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
			$printer->feed(1); //Alimentamos el papel 1 vez*/
			$printer->text("DIGITAL PLUS"."\n");//Nombre de la empresa
			$printer->text("SENOR Q.ROO COL. CENTRO"."\n");//Dirección de la empresa
			$printer->text("Tel.: 983 809 43 88"."\n");//Teléfono de la empresa
            $printer->text("Folio:".$folio."\n");//Número de factura
			$printer->text(date("Y-m-d H:i:s A")."\n");//Fecha de la factura
            $printer->text("\n");			
            $printer->text("Le atiende: ".$user["name"]."\n");//Nombre del vendedor
            $printer->text("\n");
            $printer->text("DESCRIPCION     CANT.    IMPORTE"."\n");//Nombre de la empresa
			$printer->text("================================"."\n");//Nombre de la empresa        
            foreach($items as $data){ // recorro el array y voy imprimiendo los items
                //$printer->setJustification(Printer::JUSTIFY_LEFT);
				//$printer->text($data["descripcion"]."\n");//Nombre/descripcion del producto
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $subtotal = number_format($data["precio"],2) * $data["cantidad"];
                if(strlen($data["descripcion"])>13){
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
				    $printer->text($data["descripcion"]."\n");//Nombre/descripcion del producto
                    $printer->text("               ".$data["cantidad"]."   "."$".number_format($subtotal,2)."\n");
                }else{
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
				    $printer->text($data["descripcion"]."    ".$data["cantidad"]."   "."$".number_format($subtotal,2)."\n");
                }
            }
            $printer->text("\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("IVA: $".number_format($cabecera["iva"],2)."\n");//Iva
            $printer->text("SubTotal: $".number_format($cabecera["subTotal"],2)."\n");//subTotal
            $printer->text("Total: $".number_format($cabecera["total"],2)."\n");//Total
            $printer->text("Pago con: $".number_format($cabecera["pagaCon"],2)."\n");//Nombre del vendedor
            $printer->text("Su cambio: $".number_format($cabecera["cambio"],2)."\n");//Nombre del vendedor
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("\n");
            $printer->text("GRACIAS POR SU COMPRA,"."\n");//thanks
            $printer->text("VUELVA PRONTO"."\n");//thanks

            $printer->text("\n");
            $printer->text("\n");
            $printer->text("\n");
            $printer->cut();
            /* Close printer */
            $printer->close();
        } catch (Exception $e) {
            echo "No se puede imprimir con esta impresora: ".$e->getMessage()."\n";
        }
        
    }

    public function imprimeTicketPorIpRed($printer,$cabecera,$items)
    {
        $ip = $printer['ip'];
        $port = 9100;
        $conector = new NetworkPrintConnector($ip, $port);
        $impresora = new Printer($conector);
        try {
            $impresora->text("titulo\n");
            $impresora->text("-----------------------\n");
            $impresora->text("cuerpo del ticket\n");
            $impresora->cut(); 
            $impresora->text("\n");
        } finally {
            $impresora->close();
        }
    }
}
