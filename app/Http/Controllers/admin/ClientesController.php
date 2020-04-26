<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('admin.clientes.index', compact('clientes'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar el formulario
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        
        $cliente = Cliente::create($data);
        
        return redirect()->route('admin.clientes.edit', compact('cliente'))->withFlash('El usuario ha sido creado');
    }

    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente'));
        
    }

    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'name'=>'required'
        ]);

        $cliente->update($data);

        return back()->withFlash('Cliente actualizado');
    }

   
    public function destroy($idCliente) //solo el admin hace esto
    {
        $cliente = Cliente::find($idCliente); //busco al usuario a borrar

       // $this->authorize('delete',$cliente); // autorizo el delete, usando el policy

        $cliente->delete();

        return response()->json(['mensaje'=>'Cliente eliminado']);
    }
}
