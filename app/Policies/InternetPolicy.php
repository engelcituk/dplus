<?php

namespace App\Policies;

use App\Internet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternetPolicy
{
    use HandlesAuthorization;

    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }
    public function view(User $user, Internet $internet)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View internet service');                        
    }

  
    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create internet service');        
        
    }

    public function update(User $user, Internet $internet)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update internet service');        
        
    }

    
    public function delete(User $user, Internet $internet)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete internet service');                        
    }
}
