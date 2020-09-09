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
use App\Internet;
use App\Recarga;
use App\Producto;
use App\Cliente;
use App\Transaction;
use App\Total;
use App\Printer as MiniPrinter; // con alias porque choca con la clase de la librería de mike42
use Carbon\Carbon;


class VentasController extends Controller {
    
    public function index()
    {
        $tvServicios = Television::all();
        $internetServicios = Internet::all();


        return view('admin.ventas.index', compact('tvServicios','internetServicios'));
    }

    public function getClientesTV(Request $request){
    
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

    public function getClientesInternet(Request $request){
    
        $datosCliente = $request->get('datosCliente');

        $clientes = DB::table('cliente_internet')
        ->where(function($query) use ($datosCliente){
            $query->where('clientes.name', 'like', '%'.$datosCliente.'%');
            //$query->orWhere('cliente_television.referencia', 'like', '%'.$datosCliente.'%');
        })
        ->join('clientes', 'clientes.id', '=', 'cliente_internet.cliente_id')
        ->join('internets', 'internets.id', '=', 'cliente_internet.internet_id')
        ->select('clientes.id as idCliente','cliente_internet.internet_id as idInternet','clientes.name','internets.code as code','internets.name as nameServicio', 'internets.description as description','internets.price as precio','internets.assurance as seguro','internets.final_price as precioFinal','internets.iva as iva','cliente_internet.antenna_ip','cliente_internet.date_expiration')
        ->get();

        return response()->json(
            [
                'ok' => true,
                'mensaje' => 'Datos de los clientes obtenidos',
                'clientes' => $clientes,
            ]
        );
    }

    public function getListaRecargas(Request $request){
        
        $datosRecarga = $request->get('datosRecarga');
    
        $recargas = Recarga::where('description', 'like', '%' .$datosRecarga. '%')->orWhere('price', 'like', '%' .$datosRecarga. '%')->orWhere('code', 'like', '%' .$datosRecarga. '%')->get();

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'llegaste aquí',
            'recargas' => $recargas,
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

    public function getDataClienteTV(Request $request){
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
    public function getDataClienteInternet(Request $request){
        $idCliente = $request->get('id');

        $cliente = Cliente::with('internets')->find($idCliente); //obtengo el cliente y los datos de su servicio de internet mediante su relacion
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

    public function saveClienteTV(Request $request){

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
        } else {

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

    public function updateClienteTV(Request $request){

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

    public function updateClienteInternet(Request $request){

        $nombreCliente = trim(ucwords($request->get('nombreCliente'),' '));
        $idCliente = $request->get('idCliente');

        $formData = array('name'=>$nombreCliente); //array con los campos para el cliente
        $dateExpiration = \Carbon\Carbon::parse($request->get('fechaInicio') )->addDays(30); //le sumo 30 dias con carbon

        
        Cliente::whereId($idCliente)->update($formData);//actualizo, aunque no es necesario
        $cliente = Cliente::find($idCliente);
        // detach y attach de servicios de TV            
        $cliente->internets()->detach();
        $cliente->internets()->attach(
            $request->get('idInternet'), 
            [
                'antenna_ip' => $request->get('ipAntena'),
                'client_ip' =>$request->get('ipCliente'),
                'antenna_password' => $request->get('passwordAntena'),
                'router_password' => $request->get('passwordRouter'),
                'date_start' => $request->get('fechaInicio'),
                'date_expiration' => $dateExpiration
            ]
        );
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

    public function cobrar(Request $request){

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
                'transactionable_id' => $data['transactionable_id'], //id del modelo como tv, internet 
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

            if($data['idCliente'] != '' && $data['transactionable_type'] == 'App\Internet' ){ //si idCliente no viene vacio
                $this->updateFechaExpiracionPagoInternet($data['idCliente'], $data['transactionable_id']);
            }
        }
        
       /* if($necesitaTicket){// si necesita ticket se manda a ticket de impresoras
            $printer = MiniPrinter::where('available', 1)->Where('default',1)->first();//get first miniprinter available and default
            if($printer){ // si hay impresora, mando a imprimir
                $modoUso = $printer['use_mode']; // se obtiene el tipo de impresora
                if ($modoUso == 'usb/compartido') {// si por compartido usb, se manda a esa impresora
                    $this->imprimeTicketPorUsbCompartido($printer,$cabecera,$items);
                } elseif ($modoUso == 'red/ip') {//si es por red
                    // $this->imprimeTicketPorIpRed($printer,$cabecera,$items);
                }
            }
        }*/
        
        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'Cobro realizado exitosamente',
            //'cliente'=>  $cliente->internets[0]->pivot
            ]
        );
    }

    public function updateFechaExpiracionPagoInternet($idCliente, $idInternet){

        $cliente = Cliente::with('internets')->find($idCliente); //obtengo el cliente y los datos de su servicio de tv mediante su relacion
        
        $dateStart = $cliente->internets[0]->pivot->date_expiration;
        $dateExpiration = \Carbon\Carbon::parse( $dateStart )->addDays(30); //le sumo 30 dias con carbon
        $antenaIp = $cliente->internets[0]->pivot->antenna_ip;
        $clienteIp = $cliente->internets[0]->pivot->client_ip;
        $antennaPassword = $cliente->internets[0]->pivot->antenna_password;
        $routerPassword = $cliente->internets[0]->pivot->router_password;  

        // detach y attach de servicios de wifi del cliente
        $cliente->internets()->detach();
        $cliente->internets()->attach(
            $idInternet, 
            [
                'antenna_ip' => $antenaIp,
                'client_ip' =>$clienteIp,
                'antenna_password' => $antennaPassword,
                'router_password' => $routerPassword,
                'date_start' => $dateStart,
                'date_expiration' => $dateExpiration
            ]
        );
        
    }

    public function imprimeTicketPorUsbCompartido($printer,$cabecera,$items){

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
                $precioSinIva = $data["iva"] == 1 ? $data["precio"] / 1.16 : $data["precio"];
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $subtotal = number_format($precioSinIva,2) * $data["cantidad"];
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
