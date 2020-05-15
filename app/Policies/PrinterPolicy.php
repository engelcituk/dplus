<?php

namespace App\Policies;

use App\Printer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrinterPolicy
{
    use HandlesAuthorization;
    
    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }

    public function view(User $user, Printer $printer)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View pos printer');                        
    }

  
    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create pos printer');        
    }

    public function update(User $user, Printer $printer)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update pos printer');        
        
    }

  
    public function delete(User $user, Printer $printer)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete pos printer');                        
        
    }

}
