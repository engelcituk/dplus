<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
   
    public function index()
    {
        $categorias = Category::all();

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
        
    }

   
    public function store(Request $request)
    {
        //Validar el formulario
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        
        $categoria = Category::create($data);
        
        return redirect()->route('admin.categorias.edit', compact('categoria'))->withFlash('La categoría ha sido creado');
    }

   
    public function show(Category $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));        
    }

  
    public function edit(Category $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
        
    }

  
    public function update(Request $request, Category $categoria)
    {
        $data = $request->validate([
            'name'=>'required'
        ]);

        $categoria->update($data);

        return back()->withFlash('Categoría actualizada');
    }

    
    public function destroy($idCaegoria)
    {
        $categoria = Category::find($idCaegoria); //busco al usuario a borrar

       // $this->authorize('delete',$categoria); // autorizo el delete, usando el policy

        $categoria->delete();

        return response()->json(['mensaje'=>'Cliente eliminado']);
    }
}
