<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Television;
use App\DaysPeriod;
use App\Category;

class TelevisionController extends Controller
{
    
    public function index()
    {
        $this->authorize('view', new Television);

        $serviciosTV = Television::all();

        return view('admin.television.index', compact('serviciosTV'));
    }

  
    public function create()
    {
        $this->authorize('create', new Television);
        $categorias = Category::all();
        $periodos = DaysPeriod::all();

        return view('admin.television.create', compact('periodos','categorias'));
    }

    
    public function store(Request $request)
    {
        $this->authorize('create', new Television);

         //Validar el formulario
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id'=>'required',
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
        $this->authorize('view', $television);

        return view('admin.television.show', compact('television'));
    }

  
    public function edit(Television $television)
    {
        $this->authorize('update', $television);
        $categorias = Category::all();
        $periodos = DaysPeriod::all();

        return view('admin.television.edit', compact('periodos','television','categorias'));
    }

 
    public function update(Request $request, Television $television)
    {
        $this->authorize('update', $television);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'category_id'=>'required', 
            'days_periods_id'=>'required', 
            'price' => 'required',
            'commission' => 'required',
            'final_price' => 'required'
            
        ]);

        $television->update($data);

        return back()->withFlash('Servicio actualizado');
    }

    public function destroy($idServicio) 
    {
        $authUser = Auth::user(); // get current logged in user
        $servicioTV = Television::find($idServicio); //busco al usuario a borrar

        if($authUser->can('delete',$servicioTV)){ //si user autenticado puede borrar pd
            $servicioTV->delete();
            $ok= true;
            $mensaje='Servicio de tv eliminada eliminada';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar el servicio de tv';
        }
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }
}
