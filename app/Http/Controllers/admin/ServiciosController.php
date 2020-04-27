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
        //
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($idServicio) //solo el admin hace esto
    {
        $servicio = Servicio::find($idServicio); //busco al usuario a borrar

       // $this->authorize('delete',$servicio); // autorizo el delete, usando el policy

        $servicio->delete();

        return response()->json(['mensaje'=>'Servicio eliminado']);
    }
}
