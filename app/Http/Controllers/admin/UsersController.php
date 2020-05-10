<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
   
    public function index()
    {
        $users = User::allowed()->get();

        return view('admin.users.index', compact('users'));
    }

  
    public function create()
    {
        $user = new User;

        $this->authorize('create',$user); // autorizo el create, usando el policy create

        return view('admin.users.create');
        
    }

    public function store(Request $request)
    {
       $this->authorize('create', new User); // autorizo el store, usando el policy create

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        // genero una contraseña aleatoria
        $data['password'] = str_random(8);

        $user = User::create($data);

        return redirect()->route('admin.users.edit', compact('user'))->withFlash('El usuario ha sido creado');


    }

   
    public function show(User $user)
    {
       $this->authorize('view',$user); // autorizo el show, usando el policy view

        return view('admin.users.show', compact('user'));
        
    }

 
    public function edit(User $user)
    {
       $this->authorize('update',$user); // autorizo el update, usando el policy

         //$roles = Role::pluck('name','id');
         $roles = Role::with('permissions')->get();
         
         $permissions = Permission::pluck('name','id');

        return view('admin.users.edit', compact('user','roles','permissions'));
        
    }

   
    public function update(UpdateUserRequest $request, User $user)
    {
        
        $this->authorize('update',$user); // autorizo el update, usando el policy

        $user->update($request->validated()); //la logica de validacion está en el formRequest UpdateUserRequest 

        return back()->withFlash('Usuario actualizado');
    }

    public function destroy($idUsuario) //solo el admin hace esto
    {
        
        $authUser = Auth::user(); // get current logged in user
        $user = User::find($idUsuario); //busco al usuario a borrar
        
        if($authUser->can('delete',$user)){
            $user->delete();
            $ok= true;
            $mensaje='Usuario eliminado';
        }else{
            $ok= false;
            $mensaje='No se puede eliminar al usuario';
        }
        
         return response()->json(
            [
            'ok' => $ok,
            'mensaje' => $mensaje
            ]
        );
    }
}
