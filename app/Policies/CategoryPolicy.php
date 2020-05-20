<?php

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

   
    public function before($user) // funcion que se ejecuta primero
    {
        if ($user->hasRole('Admin')) { // si el user es admin le damos acceso a todo
            return  true;
        } 
    }
 
    public function view(User $user, Category $category)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('View categories');        
        
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Create categories');        
    }
  
    public function update(User $user, Category $category)
    {
        return $user->hasRole('Admin')  || $user->hasPermissionTo('Update categories');        
    }
 
    public function delete(User $user, Category $category)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Delete categories');                
    }

}
