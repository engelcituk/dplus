<?php

namespace App\Policies;

use App\Cliente;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }
 
    public function view(User $user, Cliente $cliente)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View clients');        
    }

    
    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create clients');
        
    }

   
    public function update(User $user, Cliente $cliente)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update clients');
        
    }

    
    public function delete(User $user, Cliente $cliente)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete clients');        
        
    }

   
    
}
