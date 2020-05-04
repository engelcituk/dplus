<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Internet;
use App\DaysPeriod;

class InternetsController extends Controller
{
   
    public function index()
    {
        $serviciosInternet = Internet::all();

        return view('admin.internet.index', compact('serviciosInternet'));
    }

    
    public function create()
    {
        $periodos = DaysPeriod::all();

        return view('admin.internet.create', compact('periodos'));
    }

 
    public function store(Request $request)
    {
         //Validar el formulario
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'days_periods_id'=>'required',
            'description' => 'required',
            'price' => 'required',
            'assurance' => 'required',
            'final_price' => 'required'
            
        ]);
        
        $internet = Internet::create($data);
        
        return redirect()->route('admin.internet.edit', compact('internet'))->withFlash('El servicio de internet ha sido creado');
    }

 
    public function show(Internet $internet)
    {
    
        return view('admin.internet.show', compact('internet'));
    }

 
    public function edit(Internet $internet)
    {
        $periodos = DaysPeriod::all();

        return view('admin.internet.edit', compact('periodos','internet'));
    }

  
    public function update(Request $request, Internet $internet)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'days_periods_id'=>'required', 
            'description' => 'required',
            'price' => 'required',  
            'assurance' => 'required',
            'final_price' => 'required'
            
        ]);

        $internet->update($data);

        return back()->withFlash('Servicio actualizado');
    }

    public function destroy($idServicio) //solo el admin hace esto
    {
        $servicio = Internet::find($idServicio); //busco al usuario a borrar

       // $this->authorize('delete',$servicio); // autorizo el delete, usando el policy

        $servicio->delete();

        return response()->json(['mensaje'=>'Servicio eliminado']);
    }
}
