<?php

namespace App\Policies;

use App\Recarga;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecargaPolicy
{
    use HandlesAuthorization;

    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }

    public function view(User $user, Recarga $producto)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View recargas');                                
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create recargas');                
    }

    public function update(User $user, Recarga $producto)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update recargas');                
    }

  
    public function delete(User $user, Recarga $producto)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update recargas');                
    }
}
