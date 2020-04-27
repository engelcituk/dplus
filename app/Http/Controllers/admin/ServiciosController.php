<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Servicio;
use App\Category;

class ServiciosController extends Controller
{
  
    public function index()
    {
        $servicios = Servicio::all();

        return view('admin.servicios.index', compact('servicios'));
    }

    public function create()
    {
        $categorias = Category::all();

        return view('admin.servicios.create', compact('categorias'));
        
    }

  
    public function store(Request $request)
    {
         //Validar el formulario
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'category_id'=>'required',
            'price' => 'required',
            'commission' => 'required',
            'final_price' => 'required'
            
        ]);
        
        $servicio = Servicio::create($data);
        
        return redirect()->route('admin.servicios.edit', compact('servicio'))->withFlash('El servicio ha sido creado');
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit(Servicio $servicio)
    {
        $categorias = Category::all();

        return view('admin.servicios.edit', compact('categorias','servicio'));
        
    }

   
    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'category_id'=>'required',
            'price' => 'required',
            'commission' => 'required',
            'final_price' => 'required'
            
        ]);

        $servicio->update($data);

        return back()->withFlash('Servicio actualizado');
    }

 
    public function destroy($idServicio) //solo el admin hace esto
    {
        $servicio = Servicio::find($idServicio); //busco al usuario a borrar

       // $this->authorize('delete',$servicio); // autorizo el delete, usando el policy

        $servicio->delete();

        return response()->json(['mensaje'=>'Servicio eliminado']);
    }
}
