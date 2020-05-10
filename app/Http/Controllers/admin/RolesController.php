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
            'name' => 'required|unique:roles',
            'display_name' => 'required', 
            //'guard_name' => 'required'
        ]);
        

       $role = Role::create($data);

       if($request->has('permissions')){

           $role->givePermissionTo($request->permissions);
       }

       return redirect()->route('admin.roles.edit',compact('role'))->withFlash('El rol fue creado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name','id');
        
        return view('admin.roles.edit', compact('permissions','role'));        
        
    }


    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            //'name' => 'required|unique:roles,name,' .$role->id,
            'display_name' => 'required', 
            //'guard_name' => 'required'
        ]);

        $role->update($data);

        $role->permissions()->detach();
        
        if($request->has('permissions')){

            $role->givePermissionTo($request->permissions);
        } 
 
       return redirect()->route('admin.roles.edit', $role)->withFlash('El rol fue actualizado correctamente');
    
    }

 
    public function destroy($id)
    {
        //
    }
}
