<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cliente;
use App\Television;
use App\Internet;

class ClientesController extends Controller
{
   
    public function index()
    {
       $this->authorize('view', new Cliente);

        $clientes = Cliente::all();

        return view('admin.clientes.index', compact('clientes'));
        
    }

  
    public function create()
    {
       $this->authorize('create', new Cliente);

        return view('admin.clientes.create');
        
    }

   
    public function store(Request $request)
    {
       $this->authorize('create',new Cliente);// politica de acceso

        //Validar el formulario
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        //primera letra en mayuscula, su separador espacio en blanco, trim para eliminar espacios en blanco al final e inicio de la cadena
        $data['name'] = trim(ucwords($data['name'],' '));
        $cliente = Cliente::create($data);
        
        return redirect()->route('admin.clientes.edit', compact('cliente'))->withFlash('El cliente ha sido creado');
    }

    public function show(Cliente $cliente)
    {
       $this->authorize('view', $cliente);

        return view('admin.clientes.show', compact('cliente'));
        
    }

    public function edit(Cliente $cliente)
    {
       $this->authorize('update',$cliente);

        $tvServicios = Television::all();
        $wifiServicios = Internet::all();

        $clienteTelevision = $cliente->televisions()->where('cliente_id', $cliente->id)->first(); // verfico si hay cliente tv
        $clienteInternet = $cliente->internets()->where('cliente_id', $cliente->id)->first(); // verfico si hay cliente wifi
        
        $clienteTV = $clienteTelevision ? $cliente->televisions()->where('cliente_id', $cliente->id)->first() :  null;
        $clienteWifi = $clienteInternet ? $cliente->internets()->where('cliente_id', $cliente->id)->first() :  null;

       
        return view('admin.clientes.edit', compact('cliente','clienteTV','clienteWifi','tvServicios','wifiServicios'));
        
    }

    
    public function update(Request $request, Cliente $cliente)
    {
       $this->authorize('update',$cliente); // politica de acceso

        $data = $request->validate([
            'name'=>'required'
        ]);

        $cliente->update($data);
        // detach y attach de servicios de TV
        $cliente->televisions()->detach();
        $cliente->televisions()->attach($request->get('televisions'),['referencia'=>$request->get('referencia')]);

        // detach y attach de servicios de wifi
        $cliente->internets()->detach();
        $cliente->internets()->attach(
            $request->get('internets'), 
            [
                'antenna_ip' => $request->get('antenna_ip'),
                'client_ip' =>$request->get('client_ip'),
                'antenna_password' => $request->get('antenna_password'),
                'router_password' => $request->get('router_password')
            ]
        );

        return back()->withFlash('Cliente actualizado');
    }

   
    public function destroy($idCliente) //solo el admin hace esto
    {
        $authUser = Auth::user(); // get current logged in user
        $cliente = Cliente::find($idCliente); //busco al cliente a borrar

        if($authUser->can('delete',$cliente)){ //si user autenticado puede borrar al cliente
            $cliente->delete();
            $ok= true;
            $mensaje='Cliente eliminado';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar al cliente';
        }

        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }
}
