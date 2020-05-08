<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
   
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

  
    public function create()
    {
        return view('admin.users.create');
        
    }

    public function store(Request $request)
    {
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
        return view('admin.users.show', compact('user'));
        
    }

 
    public function edit(User $user)
    {
        return $roles = Role::all();
        return view('admin.users.edit', compact('user'));
        
    }

   
    public function update(UpdateUserRequest $request, User $user)
    {
        

        $user->update($request->validated()); //la logica de validacion está en el formRequest UpdateUserRequest 

        return back()->withFlash('Usuario actualizado');
    }

    public function destroy($idUsuario) //solo el admin hace esto
    {
        $usuario = User::find($idUsuario); //busco al usuario a borrar

       // $this->authorize('delete',$usuario); // autorizo el delete, usando el policy

        $usuario->delete();

        return response()->json(['mensaje'=>'Usuario eliminado']);
    }
}
