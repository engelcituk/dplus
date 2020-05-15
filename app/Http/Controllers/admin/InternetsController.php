<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Internet;
use App\DaysPeriod;

class InternetsController extends Controller
{
   
    public function index()
    {
       $this->authorize('view', new Internet);

        $serviciosInternet = Internet::all();

        return view('admin.internet.index', compact('serviciosInternet'));
    }

    
    public function create()
    {
       $this->authorize('create', new Internet);

        $periodos = DaysPeriod::all();

        return view('admin.internet.create', compact('periodos'));
    }

 
    public function store(Request $request)
    {
        $this->authorize('create',new Internet);// politica de acceso

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
       $this->authorize('view', $internet);
       
       return view('admin.internet.show', compact('internet'));
    }

 
    public function edit(Internet $internet)
    {
       $this->authorize('update',$internet);

        $periodos = DaysPeriod::all();

        return view('admin.internet.edit', compact('periodos','internet'));
    }

  
    public function update(Request $request, Internet $internet)
    {
       $this->authorize('update',$internet);
       
       $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'days_periods_id'=>'required', 
            'description' => 'required',
            'price' => 'required',  
            'assurance' => 'required',
            'final_price' => 'required'
            
        ]);

        $internet->update($data);

        return back()->withFlash('Servicio de internet actualizado');
    }

    public function destroy($idServicio) 
    {
        $authUser = Auth::user(); // get current logged in user
        $servicioInternet = Internet::find($idServicio); //busco al usuario a borrar

        if($authUser->can('delete',$servicioInternet)){ //si user autenticado puede borrar pd
            $servicioInternet->delete();
            $ok= true;
            $mensaje='Servicio de internet eliminado';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar el servicio de internet';
        }
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }

}
