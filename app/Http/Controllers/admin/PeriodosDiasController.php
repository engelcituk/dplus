<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DaysPeriod;

class PeriodosDiasController extends Controller
{
    
    public function index()
    {
        $this->authorize('view', new DaysPeriod);

        $periodoDias = DaysPeriod::all();

        return view('admin.periododias.index', compact('periodoDias'));
    }

    public function create()
    {
        $this->authorize('create', new DaysPeriod);

        return view('admin.periododias.create');
        
    }

    public function store(Request $request)
    {
        $this->authorize('create', new DaysPeriod);

        //Validar el formulario
        $data = $request->validate([
            'days_number' => 'required',
            'description' => 'required'
        ]);
        
        $periododia = DaysPeriod::create($data);
        
        return redirect()->route('admin.periododias.edit', compact('periododia'))->withFlash('El periode de días ha sido creado');
    }


    public function show(DaysPeriod $periododia)
    {
        $this->authorize('view', $periododia);

        return view('admin.periododias.show', compact('periododia'));
        
    }

   
    public function edit(DaysPeriod $periododia)
    {
        $this->authorize('update', $periododia);

        return view('admin.periododias.edit', compact('periododia'));
        
    }

   
    public function update(Request $request, DaysPeriod $periododia)
    {
        $this->authorize('update', $periododia);

        $data = $request->validate([
            'days_number' => 'required',
            'description' => 'required'
        ]);

        $periododia->update($data);

        return back()->withFlash('Perido de días actualizado');
    }

  
    public function destroy($idPeriodoDia) //solo el admin hace esto
    {
        $authUser = Auth::user(); // get current logged in user
        $periodoDia = DaysPeriod::find($idPeriodoDia); //busco al dato a borrar

        if($authUser->can('delete',$periodoDia)){ //si user autenticado puede borrar pd
            $periodoDia->delete();
            $ok= true;
            $mensaje='Periodo de días eliminado';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar el periodo de días';
        }
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }
   

}
