<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersRolesController extends Controller
{
  
    public function update(Request $request, User $user)
    {
         $user->syncRoles($request->roles); // el paquete de roles de spatie admite el name y no el id

        return back()->withFlash('Roles de usuario actualizados');

    }

}
