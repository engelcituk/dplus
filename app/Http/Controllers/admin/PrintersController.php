<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Printer;

class PrintersController extends Controller
{
  
    public function index()
    {
        $printers = Printer::all();

        return view('admin.printers.index', compact('printers'));
    }

  
    public function create()
    {
        return view('admin.printers.create');        
        
    }

  
    public function store(Request $request)
    {
        
        //Validar el formulario
        $data = $request->validate([
            'name'=>'required',
            'shared_name' => 'required|unique:printers',
            'ip' => 'required|unique:printers',
            'use_mode' => 'required'
        ]);

        //ocupé este método porque con el create daba errores con los checkboxes
        $printer = new Printer;
        $printer->name = $request->name;
        $printer->shared_name =  $request->shared_name;
        $printer->ip = $request->ip;
        $printer->available = $request->available ? true : false;
        $printer->default =  $request->default ? true : false;
        $printer->use_mode =  $request->use_mode;
        $printer->save();
        
        return redirect()->route('admin.printers.edit', compact('printer'))->withFlash('La impresora de tickets ha sido creado');
    }

 
    public function show(Printer $printer)
    {
        return view('admin.printers.show', compact('printer'));
    }

    
    public function edit(Printer $printer)
    {
        return view('admin.printers.edit', compact('printer'));
        
    }

    public function update(Request $request, Printer $printer)
    {
        
        $printer->available = $request->available ? true : false;
        $printer->default = $request->default? true : false;

        $data = $request->validate([
            'name'=>'required',
            'shared_name' => 'required|unique:printers,shared_name,'.$printer->id,
            'ip' => 'required|unique:printers,ip,'.$printer->id,
            'use_mode' => 'required',

        ]);

        $printer->update($data);

        return back()->withFlash('Impresora de tickets actualizada');

    }
   
    public function destroy($idImpresora) //solo el admin hace esto
    {
        $printer = Printer::find($idImpresora); //busco al usuario a borrar

       // $this->authorize('delete',$printer); // autorizo el delete, usando el policy

        $printer->delete();

        return response()->json(
            [
            'ok' => true,
            'mensaje' => 'La impresora ha sido borrado'
            ]
        );
    }
}
