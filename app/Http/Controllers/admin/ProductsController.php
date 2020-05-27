<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;

class ProductsController extends Controller
{
    public function index()
    {  
       //$this->authorize('view', new Producto);
       
       $products = Producto::all();

       return view('admin.products.index', compact('products'));
        
    }
}
