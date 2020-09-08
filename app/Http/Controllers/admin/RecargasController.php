<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Recarga;
use App\Category;

class RecargasController extends Controller
{
    public function index()
    {
       $this->authorize('view', new Recarga);

        $recargas = Recarga::all();

        return view('admin.recargas.index', compact('recargas'));
    }

    public function create()
    {
        $this->authorize('create', new Recarga);
        $categorias = Category::all();

        return view('admin.recargas.create',compact('categorias'));        
        
    }

    public function show(Recarga $recarga){
        
        $this->authorize('view',$recarga);

        return view('admin.recargas.show', compact('recarga'));   
    }

    public function edit(Recarga $recarga){
        
        $this->authorize('update',$recarga);

        $categorias = Category::all();

        return view('admin.recargas.edit', compact('recarga','categorias'));
    }

    public function store(Request $request)
    { 
       $this->authorize('create',new Recarga);// politica de acceso

        //Validar el formulario
        $data = $request->validate([
            'code' => ['required','unique:recargas,code'],
            'category_id'=>'required', 
            'description' => 'required',
            'price' => 'required',
            'commission'=>'required', 
            'iva' => 'required',
            'final_price' => 'required'
        ]);

        Recarga::create($data);
        
        return redirect()->route('admin.recargas.index')->withFlash('La recarga ha sido creado');
    }

    public function update(Request $request,Recarga $recarga)
    {
       $this->authorize('update',$recarga); // politica de acceso

        $data = $request->validate([
            'code' => ['required','unique:recargas,code,'.$recarga->id],
            'category_id'=>'required', 
            'description' => 'required',
            'price' => 'required',
            'commission'=>'required', 
            'iva' => 'required',
            'final_price' => 'required'
        ]);

        $recarga->update($data);
        
        return back()->withFlash('Recarga actualizado');
    }

    public function destroy($idRecarga) //solo el admin hace esto
    {
        $authUser = Auth::user(); // get current logged in user
        $recarga = Recarga::find($idRecarga); //busco el recarga a borrar

        if($authUser->can('delete',$recarga)){ //si user autenticado puede borrar recarga
            $recarga->delete();
            $ok= true;
            $mensaje='Recarga borrada';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar la recarga';
        }
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }
}
