<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DaysPeriod;

class PeriodosDiasController extends Controller
{
    
    public function index()
    {
        $periodoDias = DaysPeriod::all();

        return view('admin.periododias.index', compact('periodoDias'));
    }

    public function create()
    {
        return view('admin.periododias.create');
        
    }

    public function store(Request $request)
    {
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
        return view('admin.periododias.show', compact('periododia'));
        
    }

   
    public function edit(DaysPeriod $periododia)
    {
        return view('admin.periododias.edit', compact('periododia'));
        
    }

   
    public function update(Request $request, DaysPeriod $periododia)
    {
        $data = $request->validate([
            'days_number' => 'required',
            'description' => 'required'
        ]);

        $periododia->update($data);

        return back()->withFlash('Perido de días actualizado');
    }

  
    public function destroy($idPeriodoDia) //solo el admin hace esto
    {
        $periodoDia = DaysPeriod::find($idPeriodoDia); //busco al usuario a borrar

       // $this->authorize('delete',$periodoDia); // autorizo el delete, usando el policy

        $periodoDia->delete();

        return response()->json(['mensaje'=>'Periodo de días eliminado']);
    }

}
