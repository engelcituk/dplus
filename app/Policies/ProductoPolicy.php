<?php

namespace App\Policies;

use App\Producto;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy
{
    use HandlesAuthorization; 

    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }
    public function view(User $user, Producto $producto)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View product');                                
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create product');                
    }

    public function update(User $user, Producto $producto)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update product');                
    }

  
    public function delete(User $user, Producto $producto)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update product');                
    }

}
