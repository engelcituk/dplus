<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recarga;

class RecargasController extends Controller
{
    public function index()
    {
       $this->authorize('view', new Recarga);

        $recargas = Recarga::all();

        return view('admin.recargas.index', compact('recargas'));
        
    }
}
