<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\SaveRolesRequest;

class RolesController extends Controller 
{
    
    public function index()
    {
       $this->authorize('view', new Role);

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

   
    public function create()
    {
       $this->authorize('create', $role = new Role);

        $permissions = Permission::pluck('name','id');
        
        return view('admin.roles.create', compact('permissions','role'));        
    }

 
    public function store(SaveRolesRequest $request)
    {
       $this->authorize('create',new Role);

       $role = Role::create($request->validated());

       if($request->has('permissions')){

           $role->givePermissionTo($request->permissions);
       }

       return redirect()->route('admin.roles.edit',compact('role'))->withFlash('El rol fue creado correctamente');
    }


    public function edit(Role $role)
    {
        $this->authorize('update',$role);

        $permissions = Permission::pluck('name','id');
        
        return view('admin.roles.edit', compact('permissions','role'));        
        
    }


    public function update(SaveRolesRequest $request, Role $role)
    {
       $this->authorize('update',$role);

        $role->update($request->validated());

        $role->permissions()->detach();
        
        if($request->has('permissions')){

            $role->givePermissionTo($request->permissions);
        } 
 
       return redirect()->route('admin.roles.edit', $role)->withFlash('El rol fue actualizado correctamente');
    
    }

 
    public function destroy($idRol)
    {
        $authUser = Auth::user(); // get current logged in user
        $role = Role::find($idRol); //busco el role a borrar
        
        if($authUser->can('delete',$role)){ //si user autenticado puede borrar role
            $role->delete();
            $ok= true;
            $mensaje='Rol eliminado';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar el rol';
        }

        return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }
}
