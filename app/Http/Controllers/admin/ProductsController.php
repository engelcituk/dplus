<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Producto;
use App\Category;

class ProductsController extends Controller
{
    public function index()
    {  
       //$this->authorize('view', new Producto);
       
       $products = Producto::all();

       return view('admin.products.index', compact('products'));
        
    }

    public function create()
    {
        $this->authorize('create', new Producto);
        $categorias = Category::all();

        return view('admin.products.create',compact('categorias'));        
        
    }

    public function show(Producto $product){
        
        $this->authorize('view',$product);

        return view('admin.products.show', compact('product'));   
    }

    public function edit(Producto $product){
        
        $this->authorize('update',$product);

        $categorias = Category::all();

        return view('admin.products.edit', compact('product','categorias'));

    }
    public function store(Request $request)
    {
        
       $this->authorize('create',new Producto);// politica de acceso

        //Validar el formulario
        $data = $request->validate([
            'barcode' => 'required',
            'category_id'=>'required', 
            'description' => 'required',
            'price_cost' => 'required',
            'sale_price'=>'required', 
            'wholesale_price' => 'required',
            'has_inventory' => 'required',
            'units' => 'required',
            'minimum'=>'required'
        ]);

       Producto::create($data);
        
        return redirect()->route('admin.products.index')->withFlash('El producto ha sido creado');
    }

    public function update(Request $request,Producto $product)
    {
       $this->authorize('update',$product); // politica de acceso

        $data = $request->validate([
            'barcode' => 'required',
            'category_id'=>'required', 
            'description' => 'required',
            'price_cost' => 'required',
            'sale_price'=>'required', 
            'wholesale_price' => 'required',
            'has_inventory' => 'required',
            'units' => 'required',
            'minimum'=>'required'
        ]);

        $product->update($data);
        
        return back()->withFlash('Producto actualizado');
    }

    

    public function destroy($idProducto) //solo el admin hace esto
    {
        $authUser = Auth::user(); // get current logged in user
        $producto = Producto::find($idProducto); //busco el producto a borrar

        if($authUser->can('delete',$producto)){ //si user autenticado puede borrar producto
            $producto->delete();
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
