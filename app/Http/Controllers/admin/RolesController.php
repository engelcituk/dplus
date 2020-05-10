<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\SaveRolesRequest;

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

 
    public function store(SaveRolesRequest $request)
    {
       $role = Role::create($request->validated());

       if($request->has('permissions')){

           $role->givePermissionTo($request->permissions);
       }

       return redirect()->route('admin.roles.edit',compact('role'))->withFlash('El rol fue creado correctamente');
    }


    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name','id');
        
        return view('admin.roles.edit', compact('permissions','role'));        
        
    }


    public function update(SaveRolesRequest $request, Role $role)
    {
       
        $role->update($request->validated());

        $role->permissions()->detach();
        
        if($request->has('permissions')){

            $role->givePermissionTo($request->permissions);
        } 
 
       return redirect()->route('admin.roles.edit', $role)->withFlash('El rol fue actualizado correctamente');
    
    }

 
    public function destroy($idRol)
    {
        $role = Role::find($idRol); //busco el role a borrar
        
        if($role->id === 1){
            return response()->json(
                [
                'ok' => false,
                'mensaje'=>'No se puede eliminar este rol'
                ]
            );
        }

       // $this->authorize('delete',$role); // autorizo el delete, usando el policy
        $role->delete();

         return response()->json(
            [
            'ok' => true,
            'mensaje'=>'Rol eliminado'
            ]
        );
    }
}
