<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersPermissionsController extends Controller
{
   
    public function update(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions); // el paquete de roles de spatie admite el name y no el id

        return back()->withFlash('Permisos del usuario actualizados');
    }

}
