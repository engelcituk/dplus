<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Television;
use App\DaysPeriod;

class TelevisionController extends Controller
{
    
    public function index()
    {
        $serviciosTV = Television::all();

        return view('admin.television.index', compact('serviciosTV'));
    }

  
    public function create()
    {
        $periodos = DaysPeriod::all();

        return view('admin.television.create', compact('periodos'));
    }

    
    public function store(Request $request)
    {
         //Validar el formulario
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'days_periods_id'=>'required',
            'description' =>     'required',
            'price' => 'required',
            'commission' => 'required',
            'final_price' => 'required'
            
        ]);
        
        $television = Television::create($data);
        
        return redirect()->route('admin.television.edit', compact('television'))->withFlash('El servicio ha sido creado');
    }

  
    public function show(Television $television)
    {
    
        return view('admin.television.show', compact('television'));
    }

  
    public function edit(Television $television)
    {
        $periodos = DaysPeriod::all();

        return view('admin.television.edit', compact('periodos','television'));
    }

 
    public function update(Request $request, Television $television)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'days_periods_id'=>'required', 
            'price' => 'required',
            'commission' => 'required',
            'final_price' => 'required'
            
        ]);

        $television->update($data);

        return back()->withFlash('Servicio actualizado');
    }

    public function destroy($idServicio) //solo el admin hace esto
    {
        $servicio = Television::find($idServicio); //busco al usuario a borrar

       // $this->authorize('delete',$servicio); // autorizo el delete, usando el policy

        $servicio->delete();

        return response()->json(['mensaje'=>'Servicio eliminado']);
    }
}
