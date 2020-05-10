<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Admin')){
            return true;
        }
    }

    public function view(User $authUser, User $user)
    {
        return $authUser->id === $user->id || $user->hasPermissionTo('View users');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Create users');
    }

    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id || $user->hasPermissionTo('Update users');
        
    }
    public function delete(User $authUser, User $user)
    {
        return $authUser->id === $user->id || $user->hasPermissionTo('Delete users');        
    }
    
}
