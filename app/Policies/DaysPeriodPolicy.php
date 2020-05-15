<?php

namespace App\Policies;

use App\DaysPeriod;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DaysPeriodPolicy
{
    use HandlesAuthorization;

    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }
    
    public function view(User $user, DaysPeriod $daysPeriod)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View days period');                
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create days period');        
    }

   
    public function update(User $user, DaysPeriod $daysPeriod)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update days period');        
    }

  
    public function delete(User $user, DaysPeriod $daysPeriod)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete days period');                
    }

}
