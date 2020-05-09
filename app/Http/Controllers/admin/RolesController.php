<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller 
{
    
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

   
    public function create()
    {
        $permissions = Permission::pluck('name','id');
        $role = new Role;
        return view('admin.roles.create', compact('permissions','role'));        
    }

 
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required', 
            'guard_name' => 'required'
        ]);
        

       $role = Role::create($data);

       if($request->has('permissions')){

           $role->givePermissionTo($request->permissions);
       }

       return redirect()->route('admin.roles.index')->withFlash('El rol fue creado correctamente');
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

 
    public function destroy($id)
    {
        //
    }
}
