<?php

namespace App\Policies;

use App\Television;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TelevisionPolicy
{
    use HandlesAuthorization;

    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }

    public function view(User $user, Television $television)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View tv service');                                
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create tv service');                
    }
    
    public function update(User $user, Television $television)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update tv service');                
    }

    public function delete(User $user, Television $television)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete tv service');                                
    }

}
