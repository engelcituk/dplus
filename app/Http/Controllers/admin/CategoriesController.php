<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category; 

class CategoriesController extends Controller
{
    public function index()
    {  
       $this->authorize('view', new Category);
       
       $categories = Category::all();

       return view('admin.categories.index', compact('categories'));
        
    }
    public function create()
    {
        $this->authorize('create', new Category);

        return view('admin.categories.create');        
        
    }

    public function store(Request $request)
    {
       $this->authorize('create',new Category);// politica de acceso

        //Validar el formulario
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $category = Category::create($data);
        
        return redirect()->route('admin.categories.edit', compact('category'))->withFlash('La categoría ha sido creado');
    }

    public function show(Category $category){
        
        $this->authorize('view',$category);

        return view('admin.categories.show', compact('category'));   
    }

    public function edit(Category $category){
        
        $this->authorize('update',$category);

        return view('admin.categories.edit', compact('category'));


    }
    public function update(Request $request,Category $category)
    {
       $this->authorize('update',$category); // politica de acceso

        $data = $request->validate([
            'name'=>'required'
        ]);

        $category->update($data);
        
        return back()->withFlash('Categoría actualizado');
    }
    public function destroy($idCategoria) //solo el admin hace esto
    {
        $authUser = Auth::user(); // get current logged in user
        $categoria = Category::find($idCategoria); //busco al categoria a borrar

        if($authUser->can('delete',$categoria)){ //si user autenticado puede borrar la categoria
            $categoria->delete();
            $ok= true;
            $mensaje='Categoría borrada';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar la categoría';
        }
        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }

}
